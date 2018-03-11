<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\TagPropertiesRepository")
* @ORM\Table(name="TagProperties")
*/
class TagProperties
{

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