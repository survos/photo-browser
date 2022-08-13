<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\DownloadHistoryRepository::class)]
#[ORM\Table(name: 'DownloadHistory')]
class DownloadHistory implements \Stringable
{
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\Column(type: 'text', name: 'identifier')]
    private $identifier;
    public function getIdentifier() { return $this->identifier; }
    #[ORM\Column(type: 'text', name: 'filename')]
    private $filename;
    public function getFilename() { return $this->filename; }
    #[ORM\Column(type: 'integer', name: 'filesize')]
    private $filesize;
    public function getFilesize() { return $this->filesize; }
    #[ORM\Column(type: 'datetime', name: 'filedate')]
    private $filedate;
    public function getFiledate() { return $this->filedate; }
    public function __toString(): string
    {
          return $this->name;
    }
}