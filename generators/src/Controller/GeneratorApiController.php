<?php

namespace App\Controller;

use App\Entity\ErrorLogs;
use App\Entity\GeneratorSkeleton;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;


class GeneratorApiController extends AbstractController
{
    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * The method validates the data from the request.
     * 
     * @param aray $data        - request data (post - body, get - url params)
     * @param string $endpoint  - chooses the endpoint post/get endpoint 
     * 
     * @return Response
     */
    protected function validate(array $data, string $endpoint): bool
    {
        $validator = Validation::createValidator();

        $constraints = [
            'generatorId' => [
                new Assert\Type("integer"),
                new Assert\Range(['min' => GeneratorSkeleton::MIN_GENERATOR_NUMBER, 'max' => GeneratorSkeleton::MAX_GENERATOR_NUMBER]),
            ],
        ];
        switch ($endpoint) {
            case 'get_data':
                $constraints['from'] = $constraints['to'] = [
                    new Assert\LessThanOrEqual(GeneratorSkeleton::MAX_DATE_TIMESTAMP),
                    new Assert\Positive(),
                ];
                break;
            case 'set_data':
                $constraints['time'] = [
                    new Assert\LessThanOrEqual(GeneratorSkeleton::MAX_DATE_TIMESTAMP),
                    new Assert\Positive(),
                ];
                $constraints['powerKw'] = new Assert\Range([
                    'min' => GeneratorSkeleton::MIN_GENERATOR_POWER_KW,
                    'max' => GeneratorSkeleton::MAX_GENERATOR_POWER_KW,
                ]);
                break;
        }
        
        $constraintObj = new Assert\Collection($constraints);

        $validationResult = $validator->validate(
            $data,
            $constraintObj
        );

        return !$validationResult->has(0);
    }

    /**
     * @Route("/api/post", name="set_data", methods={"POST"})
     */
    public function setData(Request $request): JsonResponse
    {
        $requestBody = $request->getContent();
        $requestBodyArray = json_decode($requestBody, true);

        $generatorId = (int)@$requestBodyArray['generatorId'];
        $time = (int)@$requestBodyArray['time'];
        $powerKw = (float)@$requestBodyArray['powerKw'];
        $data = [
            'generatorId' => $generatorId,
            'time' => $time,
            'powerKw' => $powerKw,
        ];

        $entityManager = $this->doctrine->getManager();
        if ($this->validate($data, 'set_data')) {
            $className = 'App\Entity\Generator' . $generatorId;
            $generator = new $className();
            $generator->setPowerKw($powerKw);
            $generator->setTime($time);
            $entityManager->persist($generator);
            try {
                $entityManager->flush();
            } catch (\Exception $error) {
                return new JsonResponse(['error' => 'unknown error'], Response::HTTP_INTERNAL_SERVER_ERROR);    
            }

            return new JsonResponse(['info' => 'the log has been added'], Response::HTTP_CREATED);
        } else {
            $errorLogs = new ErrorLogs();
            $errorLogs->setTime(round(microtime(true) * 1000000 ));
            $errorLogs->setRequest($requestBody);
            $entityManager->persist($errorLogs);
            try {
                $entityManager->flush();
            } catch (\Exception $error) {
                return new JsonResponse(['error' => 'unknown error'], Response::HTTP_INTERNAL_SERVER_ERROR);    
            }

            return new JsonResponse(['error' => 'bad request data'], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Route("/api/get", name="get_data", methods={"GET"})
     */
    public function getData(Request $request): JsonResponse
    {
        $from = (int)$request->query->get('from');
        $to = (int)$request->query->get('to');
        $generatorId = (int)$request->query->get('generatorId');
        $data = [
            'generatorId' => $generatorId,
            'from' => $from,
            'to' => $to,
        ];

        if ($to >= $from && $this->validate($data, 'get_data')) {
            $query = $this->doctrine->getManager()->createQuery('
                SELECT gen.id, gen.powerKw, gen.time 
                FROM App\Entity\Generator' . $generatorId . ' gen 
                WHERE gen.time >= ' . $from . ' AND ' . 'gen.time <= ' . $to
            );
            $logs = $query->getResult();

            return $logs ? new JsonResponse(['logs' => $logs], Response::HTTP_OK) : new JsonResponse(['error' => 'logs not found '], Response::HTTP_NOT_FOUND);
        } else {

            return new JsonResponse(['error' => 'bad request data'], Response::HTTP_BAD_REQUEST);
        }
    }
}
