<?php

namespace App\Service;

use Doctrine\Persistence\ManagerRegistry;

final class ListLogs
{
    // tickets triggers
    private bool $internalError = false;

    // pagination data
    private int $pageLimit;
    private int $resoultsCount;
    private int $page;

    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getLogs(array $data): array
    {
        $generatorId = $data['generatorId'];
        //$from = DateTime::createFromFormat('Y-m-d H:i:s', $data['from'])->format('Y-m-d H:i:s');
        $from = $data['from'];
        $to = $data['to'];
        $this->page = $data['page'];

        if(!empty($generatorId) && !empty($from) && !empty($to)) {
            $countQuery = $this->doctrine->getManager()->createQuery('
                SELECT COUNT (rep.id) 
                FROM App\Entity\Reports rep 
                WHERE rep.datetime >= \'' . $from . '\' AND  rep.datetime <= \'' . $to . '\' AND rep.generatorId = ' . $generatorId  
            );
            $dataQuery = $this->doctrine->getManager()->createQuery('
                SELECT rep.id, rep.generatorId, rep.datetime, rep.averagePowerMw 
                FROM App\Entity\Reports rep 
                WHERE rep.datetime >= \'' . $from . '\' AND rep.datetime <= \'' . $to . '\' AND rep.generatorId = ' . $generatorId  
            );
            if (isset($this->page, $this->pageLimit)) {
                $dataQuery->setMaxResults($this->pageLimit)->setFirstResult(($this->page - 1) * $this->pageLimit);
            }
            $logs = $dataQuery->getResult();
            $this->resoultsCount = $countQuery->getResult()[0][1];
        } else {
            $this->internalError = true;
        }

        return $logs ?? [];
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function setPageLimit(int $pageLimit): void
    {
        $this->pageLimit = $pageLimit;
    }

    public function isInternalError(): bool
    {
        return $this->internalError;
    }

    public function getPagesNumber(): int
    {
        if(isset($this->resoultsCount, $this->pageLimit)) {
            return ceil($this->resoultsCount/$this->pageLimit);
        } else {
            return 0;
        }
    }

    public function getPage(): int
    {
        return !empty($this->page) ? $this->page : 1;
    }
}