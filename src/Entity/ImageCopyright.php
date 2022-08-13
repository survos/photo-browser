<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\ImageCopyrightRepository::class)]
#[ORM\Table(name: 'ImageCopyright')]
class ImageCopyright implements \Stringable
{
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\Column(type: 'integer', name: 'imageid')]
    private $imageid;
    public function getImageid() { return $this->imageid; }
    #[ORM\Column(type: 'text', name: 'property')]
    private $property;
    public function getProperty() { return $this->property; }
    #[ORM\Column(type: 'text', name: 'value')]
    private $value;
    public function getValue() { return $this->value; }
    #[ORM\Column(type: 'text', name: 'extraValue')]
    private $extraValue;
    public function getExtravalue() { return $this->extraValue; }
    public function __toString(): string
    {
          return $this->name;
    }
}