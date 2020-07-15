<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NameOfSociety;

    /**
     * @ORM\ManyToOne(targetEntity=Jobsector::class, inversedBy="client")
     */
    private $jobsector;



    public function __construct()
    {
       
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameOfSociety(): ?string
    {
        return $this->NameOfSociety;
    }

    public function setNameOfSociety(string $NameOfSociety): self
    {
        $this->NameOfSociety = $NameOfSociety;

        return $this;
    }

    public function getJobsector(): ?Jobsector
    {
        return $this->jobsector;
    }

    public function setJobsector(?Jobsector $jobsector): self
    {
        $this->jobsector = $jobsector;

        return $this;
    }




}
