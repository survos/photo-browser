<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\ImageCommentsRepository::class)]
#[ORM\Table(name: 'ImageComments')]
class ImageComments implements \Stringable
{
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\Column(type: 'integer', name: 'imageid')]
    private $imageid;
    public function getImageid() { return $this->imageid; }
    #[ORM\Column(type: 'integer', name: 'type')]
    private $type;
    public function getType() { return $this->type; }
    #[ORM\Column(type: 'text', name: 'language')]
    private $language;
    public function getLanguage() { return $this->language; }
    #[ORM\Column(type: 'text', name: 'author')]
    private $author;
    public function getAuthor() { return $this->author; }
    #[ORM\Column(type: 'datetime', name: 'date')]
    private $date;
    public function getDate() { return $this->date; }
    #[ORM\Column(type: 'text', name: 'comment')]
    private $comment;
    public function getComment() { return $this->comment; }
    public function __toString(): string
    {
          return $this->name;
    }
}