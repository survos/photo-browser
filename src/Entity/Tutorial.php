<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
 */
class Tutorial
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Step", mappedBy="tutorial")
     */
    private $steps;

    public function __construct()
    {
        $this->steps = new ArrayCollection();
    }

    /**
     *  @return Collection|Step[]
     */
    public function getSteps()
    {
        return $this->steps;
    }

    /**
     * @param mixed $steps
     */
    public function setSteps($steps): void
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
     * @param mixed $id
     * @return Tutorial
     */
    public function setId($id)
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
     * @param mixed $name
     * @return Tutorial
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
