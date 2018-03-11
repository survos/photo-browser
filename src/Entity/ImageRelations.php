<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageRelationsRepository")
* @ORM\Table(name="ImageRelations")
*/
class ImageRelations
{

/**
* @ORM\Column(type="integer", name="subject")
*/
private $subject;

    public function getSubject() { return $this->subject; }

/**
* @ORM\Column(type="integer", name="object")
*/
private $object;

    public function getObject() { return $this->object; }

/**
* @ORM\Column(type="integer", name="type")
*/
private $type;

    public function getType() { return $this->type; }


public function __toString(): string
{
      return $this->name;
}
}