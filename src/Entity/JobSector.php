<?php

namespace App\Entity;

use App\Repository\JobSectorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JobSectorRepository::class)
 */
class JobSector
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Candidate::class, inversedBy="jobSectorId")
     */
    private $jobSector;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJobSector(): ?Candidate
    {
        return $this->jobSector;
    }

    public function setJobSector(?Candidate $jobSector): self
    {
        $this->jobSector = $jobSector;

        return $this;
    }
}
