<?php

namespace App\Command;

use App\Entity\GeneratorSkeleton;
use App\Entity\Reports;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class DailyReportCommand extends Command
{
    protected static $defaultName = 'app:dailyReport';

    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
        parent::__construct();
    }

    public function createReport()
    {
        $microtime = microtime(true);
        $now = sprintf ("%.0f", round($microtime * 1000000));
        $dateTimeFormat = 'Y-m-d H:i:s';
        $dateTime = new DateTime();
        $dateTime->setTimestamp($microtime);

        $lastDayTimestamps = [];
        for ($h = 0; $h < 25; $h++) {
            $lastDayTimestamps[] = $now - $h * 3600000000;
        }
        for ($generator = GeneratorSkeleton::MIN_GENERATOR_NUMBER; $generator <= GeneratorSkeleton::MAX_GENERATOR_NUMBER; $generator++) {
            for ($h = 0; $h < 24; $h++) {
                $data = [];
                $from = $lastDayTimestamps[$h+1];
                $to =  $lastDayTimestamps[$h];
                if ($to >= $from) {
                    $query = $this->doctrine->getManager()->createQuery('
                        SELECT gen.id, gen.powerKw, gen.time 
                        FROM App\Entity\Generator' . $generator . ' gen 
                        WHERE gen.time >= ' . $from . ' AND ' . 'gen.time <= ' . $to
                    );
                    $logs = $query->getResult();
                }
                $summaryPower = 0;
                foreach ($logs as $log) {
                    $summaryPower += $log['powerKw'];
                }
                $averagePower = count($logs) > 0 ? $summaryPower/count($logs) : 0;  // some measurements may not have logged, it is better to count than hardcode 7200

                $entityManager = $this->doctrine->getManager();
                $report = new Reports();
                $report->setGeneratorId($generator);
                $report->setAveragePowerMw($averagePower);
                $report->setDatetime($dateTime);
                $entityManager->persist($report);
                $entityManager->flush();
            }
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->createReport();

        return 0;
    }
}