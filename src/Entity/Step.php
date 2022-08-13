<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\StepRepository::class)]
class Step
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[ORM\Column(type: 'string', length: 100)]
    private $name;
    #[ORM\Column(type: 'string', length: 100)]
    private $imageUrl;
    #[ORM\ManyToOne(targetEntity: \App\Entity\Tutorial::class, inversedBy: 'steps')]
    #[ORM\JoinColumn(nullable: false)]
    private $tutorial;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    public function setName(mixed $name): void
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }
    public function setImageUrl(mixed $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }
    /**
     * @return mixed
     */
    public function getTutorial()
    {
        return $this->tutorial;
    }
    public function setTutorial(mixed $tutorial): void
    {
        $this->tutorial = $tutorial;
    }
}
