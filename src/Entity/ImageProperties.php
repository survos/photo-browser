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
* @ORM\Column(type="", name="imageid")
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="text", name="property")
*/
private $property;

    public function getProperty() { return $this->property; }

/**
* @ORM\Column(type="", name="value")
*/
private $value;

    public function getValue() { return $this->value; }


public function __toString(): string
{
      return $this->name;
}
}