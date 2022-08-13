<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\TutorialRepository::class)]
class Tutorial
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;
    #[ORM\Column(type: 'string', length: 100)]
    private $name;
    #[ORM\OneToMany(targetEntity: \App\Entity\Step::class, mappedBy: 'tutorial')]
    private $steps;
    public function __construct()
    {
        $this->steps = new ArrayCollection();
    }
    /**
     *  @return Collection|Step[]
     */
    public function getSteps(): \Doctrine\Common\Collections\Collection|array
    {
        return $this->steps;
    }
    public function setSteps(mixed $steps): void
    {
        $this->steps = $steps;
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @return Tutorial
     */
    public function setId(mixed $id)
    {
        $this->id = $id;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return Tutorial
     */
    public function setName(mixed $name)
    {
        $this->name = $name;
        return $this;
    }
}
