<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImagePropertiesRepository")
* @ORM\Table(name="ImageProperties")
*/
class ImageProperties
{

/**
* @ORM\Column(type="integer", name="imageid")
 * @ORM\Id()
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

    /**
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="App\Entity\Image")
     * @ORM\JoinColumn(name="imageid", referencedColumnName="id")
     */
    protected $image;

    /**
* @ORM\Column(type="text", name="property")
 * @ORM\Id()
*/
private $property;

    public function getProperty() { return $this->property; }

/**
* @ORM\Column(type="string", name="value")
*/
private $value;

    public function getValue() { return $this->value; }


public function __toString(): string
{
      return $this->getImageid();
}
}