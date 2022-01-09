<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReportsRepository::class)
 */
class Reports
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @ORM\Column(type="smallint")
     */
    private $generatorId;

    /**
     * @ORM\Column(type="float")
     */
    private $averagePowerMw;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetime(): ?\DateTimeInterface
    {
        return $this->datetime;
    }

    public function setDatetime(\DateTimeInterface $datetime): self
    {
        $this->datetime = $datetime;

        return $this;
    }

    public function getGeneratorId(): ?int
    {
        return $this->generatorId;
    }

    public function setGeneratorId(int $generatorId): self
    {
        $this->generatorId = $generatorId;

        return $this;
    }

    public function getAveragePowerMw(): ?float
    {
        return $this->averagePowerMw;
    }

    public function setAveragePowerMw(float $averagePowerMw): self
    {
        $this->averagePowerMw = $averagePowerMw;

        return $this;
    }
}
