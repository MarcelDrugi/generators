<?php

namespace App\Command;

use App\Entity\GeneratorSkeleton;
use App\Entity\Reports;
use App\Service\ListLogs;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\Persistence\ManagerRegistry;
use \DateTime;

class SeedDataCommand extends Command
{
    const STEPS = 8760; // 24 * 365
    const BEGIN_DATE = '2019-01-01 00:00:00';

    protected static $defaultName = 'app:seedData';

    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        parent::__construct();
    }

    public function seedData()
    {
        for ($generatorId = GeneratorSkeleton::MIN_GENERATOR_NUMBER; $generatorId <= GeneratorSkeleton::MAX_GENERATOR_NUMBER; $generatorId++) {
            $entityManager = $this->doctrine->getManager();
            $entityManager->getConnection()->beginTransaction();
            
            for ($t = 0; $t < self::STEPS; $t++) {
                $date = DateTime::createFromFormat('Y-m-d H:i:s', self::BEGIN_DATE);
                $report = new Reports();
                $report->setGeneratorId($generatorId);
                $report->setAveragePowerMw(rand(0, 999)/1000);
                $report->setDatetime($date);
                $entityManager->persist($report);
                $date->modify('+ ' . $t . ' hour');
            }
            $entityManager->flush();
            $entityManager->getConnection()->commit();
            echo "Annual reports for GENERATOR $generatorId have been implemented \n";
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->seedData();

        return 0;
    }
}