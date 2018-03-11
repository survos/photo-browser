<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageHaarMatrixRepository")
* @ORM\Table(name="ImageHaarMatrix")
*/
class ImageHaarMatrix
{

/**
* @ORM\Column(type="integer", name="imageid")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="datetime", name="modificationDate")
*/
private $modificationDate;

    public function getModificationdate() { return $this->modificationDate; }

/**
* @ORM\Column(type="text", name="uniqueHash")
*/
private $uniqueHash;

    public function getUniquehash() { return $this->uniqueHash; }

/**
* @ORM\Column(type="blob", name="matrix")
*/
private $matrix;

    public function getMatrix() { return $this->matrix; }


public function __toString(): string
{
      return $this->name;
}
}