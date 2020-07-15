<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExperienceRepository::class)
 */
class Experience
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $ExperienceTime;

    /**
     * @ORM\OneToMany(targetEntity=Candidate::class, mappedBy="experience")
     */
    private $candidates;

    public function __construct()
    {
        $this->candidates = new ArrayCollection();
    }

 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExperienceTime(): ?\DateTimeInterface
    {
        return $this->ExperienceTime;
    }

    public function setExperienceTime(?\DateTimeInterface $ExperienceTime): self
    {
        $this->ExperienceTime = $ExperienceTime;

        return $this;
    }

    /**
     * @return Collection|Candidate[]
     */
    public function getCandidates(): Collection
    {
        return $this->candidates;
    }

    public function addCandidate(Candidate $candidate): self
    {
        if (!$this->candidates->contains($candidate)) {
            $this->candidates[] = $candidate;
            $candidate->setExperience($this);
        }

        return $this;
    }

    public function removeCandidate(Candidate $candidate): self
    {
        if ($this->candidates->contains($candidate)) {
            $this->candidates->removeElement($candidate);
            // set the owning side to null (unless already changed)
            if ($candidate->getExperience() === $this) {
                $candidate->setExperience(null);
            }
        }

        return $this;
    }


}
