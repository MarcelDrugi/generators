<?php

namespace App\Controller;

use App\Entity\GeneratorSkeleton;
use App\Service\ListLogs;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints as Assert;


class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request, ListLogs $listLogs): Response
    {
        // tickets triggers
        $wrongDataFormat = false;

        // pagination page
        $pageLimit = 50;

        $choices = [];
        for ($i = GeneratorSkeleton::MIN_GENERATOR_NUMBER; $i <= GeneratorSkeleton::MAX_GENERATOR_NUMBER; $i++) {
            $choices[$i] = $i;
        }
        $form = $this->createFormBuilder([])
            ->setMethod('POST')
            ->add('from', TextType::class, [
                'attr' => ['placeholder' => 'YYYY-mm-dd hh:ii:ss', 'style' => 'width: 170px; font-size: 12px'],
                'constraints' => [new Assert\Regex('/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$/')],
            ])
            ->add('to', TextType::class, [
                'attr' => ['placeholder' => 'YYYY-mm-dd hh:ii:ss', 'style' => 'width: 170px; font-size: 12px'],
                'constraints' => [new Assert\Regex('/^[0-9]{4}-[0-9]{2}-[0-9]{2}\s[0-9]{2}:[0-9]{2}:[0-9]{2}$/')],
                ])
            ->add('generatorId', ChoiceType::class, [
                'choices' => $choices,
                'constraints' => [new Assert\Range(['min' => GeneratorSkeleton::MIN_GENERATOR_NUMBER, 'max' => GeneratorSkeleton::MAX_GENERATOR_NUMBER])]
            ])
            ->add('hiddenPageNumber', HiddenType::class, ['attr' => ['id' => 'hiddenPageNumber'],])
            ->getForm();

        $logs = [];
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->isValid()) {
                $data = [];
                $data['generatorId'] = $form->get('generatorId')->getData();
                $data['from'] = $form->get('from')->getData();
                $data['to'] = $form->get('to')->getData();
                $data['page'] = (int)$form->get('hiddenPageNumber')->getData() > 1 ? (int)$form->get('hiddenPageNumber')->getData() : 1;

                $listLogs->setPageLimit($pageLimit);
                $logs = $listLogs->getLogs($data);
            } else {
                $wrongDataFormat = true;
            }
        }
        return $this->render('homepage/index.html.twig', [
            'form' => $form->createView(),
            'wrongDataFormat' => $wrongDataFormat,
            'internalError' => $listLogs->isInternalError(),
            'logs' => $logs,
            'page' => $listLogs->getPage(),
            'countQuery' => $listLogs->getPagesNumber(),
        ]);
    }
}
