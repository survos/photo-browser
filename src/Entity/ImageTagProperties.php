<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageTagPropertiesRepository")
* @ORM\Table(name="ImageTagProperties")
*/
class ImageTagProperties
{

/**
* @ORM\Column(type="integer", name="imageid")
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="integer", name="tagid")
*/
private $tagid;

    public function getTagid() { return $this->tagid; }

/**
* @ORM\Column(type="text", name="property")
*/
private $property;

    public function getProperty() { return $this->property; }

/**
* @ORM\Column(type="text", name="value")
*/
private $value;

    public function getValue() { return $this->value; }


public function __toString(): string
{
      return $this->name;
}
}