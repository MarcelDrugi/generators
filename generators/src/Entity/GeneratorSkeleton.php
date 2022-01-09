<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\MappedSuperclass;

/** @MappedSuperclass */
class GeneratorSkeleton
{
    const MIN_GENERATOR_NUMBER = 1;
    const MAX_GENERATOR_NUMBER = 20;

    const MIN_GENERATOR_POWER_KW = 0;
    const MAX_GENERATOR_POWER_KW = 1000;

    const MAX_DATE_TIMESTAMP = 9500000000000000;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="bigint")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    protected $powerKw;

    /**
     * @ORM\Column(type="bigint")
     */
    protected $time;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPowerKw(): ?float
    {
        return $this->powerKw;
    }

    public function setPowerKw(?float $powerKw): self
    {
        $this->powerKw = $powerKw;

        return $this;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }
}
