<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: \App\Repository\AlbumsRepository::class)]
#[ORM\Table(name: 'Albums')]
class Albums extends BaseEntity implements \Stringable
{
    public function __construct()
    {
        $this->images = new ArrayCollection();
    }
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId() { return $this->id; }
    #[ORM\ManyToOne(targetEntity: \App\Entity\AlbumRoots::class, inversedBy: 'albums')]
    #[ORM\JoinColumn(name: 'albumroot')]
    private $albumRoot;
    public function getAlbumroot(): AlbumRoots { return $this->albumRoot; }
    #[ORM\OneToMany(targetEntity: \App\Entity\Image::class, mappedBy: 'album', fetch: 'EAGER')]
    private $images;
    public function getImages() { return $this->images; }
    #[ORM\Column(type: 'string', name: 'relativePath')]
    private $relativePath;
    public function getRelativepath() { return $this->relativePath; }
    public function getPath() { return $this->getAlbumroot()->getSpecificpath() . $this->relativePath; }
    #[ORM\Column(type: 'date', name: 'date')]
    private $date;
    public function getDate() { return $this->date; }
    #[ORM\Column(type: 'string', name: 'caption')]
    private $caption;
    public function getCaption() { return $this->caption; }
    #[ORM\Column(type: 'text', name: 'collection')]
    private $collection;
    public function getCollection() { return $this->collection; }
    #[ORM\Column(type: 'integer', name: 'icon')]
    private $icon;
    public function getIcon() { return $this->icon; }
    public function __toString(): string
    {
          return $this->getAlbumroot() . $this->getRelativepath();
    }
    public function getUniqueIdentifiers() {
        return [
            'albumId' => $this->getId()
        ];
    }
}