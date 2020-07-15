<?php

namespace App\Entity;

use App\Repository\ExperienceRepository;
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


}
