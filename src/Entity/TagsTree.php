<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\TagsTreeRepository::class)]
#[ORM\Table(name: 'TagsTree')]
class TagsTree implements \Stringable
{
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\Column(type: 'integer', name: 'pid')]
    private $pid;
    public function getPid() { return $this->pid; }
    public function __toString(): string
    {
          return $this->getId();
    }
}