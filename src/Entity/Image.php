<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\ImageRepository::class)]
#[ORM\Table(name: 'Images')]
class Image extends BaseEntity implements \Stringable
{
    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->subjects = new ArrayCollection();
        $this->objects = new ArrayCollection();
    }
    #[ORM\Column(type: 'integer', name: 'id')]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    private $id;
    public function getId()
    {
        return $this->id;
    }
    #[ORM\ManyToOne(targetEntity: \App\Entity\Albums::class, inversedBy: 'images')]
    #[ORM\JoinColumn(name: 'album')]
    private $album;
    #[ORM\ManyToMany(targetEntity: \App\Entity\Tags::class, mappedBy: 'images')]
    #[ORM\JoinTable(name: 'ImageTags', joinColumns: [], inverseJoinColumns: [])]
    #[ORM\JoinColumn(name: 'tagid', referencedColumnName: 'id')]
    #[ORM\JoinColumn(name: 'imageid', referencedColumnName: 'id')]
    private $tags;
    public function getTags()
    {
        return $this->tags;
    }
    #[ORM\OneToOne(targetEntity: \App\Entity\ImageInformation::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'imageid')]
    private $information;
    #[ORM\OneToOne(targetEntity: \App\Entity\ImageMetadata::class, mappedBy: 'image', orphanRemoval: true, fetch: 'EAGER')]
    private $meta = null;
    #[ORM\OneToOne(targetEntity: \App\Entity\ImageHistory::class, fetch: 'EAGER')]
    #[ORM\JoinColumn(name: 'id', referencedColumnName: 'imageid')]
    private $history;
    #[ORM\OneToOne(targetEntity: \App\Entity\ImagePositions::class, mappedBy: 'image', orphanRemoval: true, fetch: 'EAGER')]
    private $location = null;
    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }
    /**
     * @return Image
     */
    public function setLocation(mixed $location)
    {
        $this->location = $location;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getMeta(): ?ImageMetadata
    {
        return $this->meta;
    }
    /**
     * @param mixed $meta
     * @return Image
     */
    public function setMeta(?ImageMetadata $meta)
    {
        $this->meta = $meta;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getInfo(): ImageInformation
    {
        return $this->information;
    }
    /**
     * @param mixed $information
     * @return Image
     */
    public function setInfo(ImageInformation $information)
    {
        $this->information = $information;
        return $this;
    }
    public function isRaw(): bool
    {
        return $this->getInfo() ? str_starts_with((string) $this->getInfo()->getFormat(), 'RAW') : true;
    }
    public function getAlbum(): ?Albums
    {
        return $this->album;
    }
    #[ORM\Column(type: 'string', name: 'name')]
    private $name;
    public function getName()
    {
        return $this->name;
    }
    #[ORM\Column(type: 'integer', name: 'status')]
    private $status;
    public function getStatus()
    {
        return $this->status;
    }
    #[ORM\Column(type: 'integer', name: 'category')]
    private $category;
    public function getCategory()
    {
        return $this->category;
    }
    #[ORM\Column(type: 'datetime', name: 'modificationDate')]
    private $modificationDate;
    public function getModificationdate()
    {
        return $this->modificationDate;
    }
    #[ORM\Column(type: 'integer', name: 'fileSize')]
    private $fileSize;
    public function getFilesize()
    {
        return $this->fileSize;
    }
    #[ORM\Column(type: 'text', name: 'uniqueHash')]
    private $uniqueHash;
    public function getUniquehash()
    {
        return $this->uniqueHash;
    }
    public function __toString(): string
    {
        return sprintf("%d: %s", $this->getId(), $this->name);
    }
    /**
     * @return mixed
     */
    public function getInformation()
    {
        return $this->information;
    }
    /**
     * @return Image
     */
    public function setInformation(mixed $information)
    {
        $this->information = $information;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getImageHistory(): ?ImageHistory
    {
        return $this->history;
    }
    /**
     * @return Image
     */
    public function setHistory(mixed $history)
    {
        $this->history = $history;
        return $this;
    }
    public function getUrlPath()
    {
        return $this->getAlbum() ? sprintf("%s/%s", $this->getAlbum()->getPath(), $this->getName()) : '#';
    }
    public function getFilePath()
    {
        return $this->getAlbum()->getAlbumroot()->getSpecificpath() . '/' . $this->getAlbum()->getRelativepath() . '/' . $this->getName();
    }
    public function getUniqueIdentifiers()
    {
        return [
            'id' => $this->getId()
        ];
    }
    /**
     * @return mixed
     */
    public function getObjects()
    {
        return $this->objects;
    }
    /**
     * @return Image
     */
    public function setObjects(mixed $objects)
    {
        $this->objects = $objects;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getSubjects()
    {
        return $this->subjects;
    }
    /**
     * @return Image
     */
    public function setSubjects(mixed $subjects)
    {
        $this->subjects = $subjects;
        return $this;
    }
}
