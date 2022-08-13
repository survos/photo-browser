<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\SearchesRepository::class)]
#[ORM\Table(name: 'Searches')]
class Searches implements \Stringable
{
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\Column(type: 'integer', name: 'type')]
    private $type;
    public function getType() { return $this->type; }
    #[ORM\Column(type: 'text', name: 'name')]
    private $name;
    public function getName() { return $this->name; }
    #[ORM\Column(type: 'text', name: 'query')]
    private $query;
    public function getQuery() { return $this->query; }
    public function __toString(): string
    {
          return $this->name;
    }
}