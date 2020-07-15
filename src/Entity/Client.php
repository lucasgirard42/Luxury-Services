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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $contactPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phoneContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $emailContact;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $notes;



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

    public function getContactName(): ?string
    {
        return $this->contactName;
    }

    public function setContactName(?string $contactName): self
    {
        $this->contactName = $contactName;

        return $this;
    }

    public function getContactPosition(): ?string
    {
        return $this->contactPosition;
    }

    public function setContactPosition(?string $contactPosition): self
    {
        $this->contactPosition = $contactPosition;

        return $this;
    }

    public function getPhoneContact(): ?string
    {
        return $this->phoneContact;
    }

    public function setPhoneContact(?string $phoneContact): self
    {
        $this->phoneContact = $phoneContact;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->emailContact;
    }

    public function setEmailContact(?string $emailContact): self
    {
        $this->emailContact = $emailContact;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }




}
