<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
* @ORM\Table(name="Images")
*/
class Image extends BaseEntity
{

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->subjects = new ArrayCollection();
        $this->objects = new ArrayCollection();
    }

/**
* @ORM\Column(type="integer", name="id")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $id;

    public function getId() { return $this->id; }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Albums", inversedBy="images")
     * @ORM\JoinColumn(name="album")
     */

private $album;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tags", mappedBy="images")
     * @ORM\JoinTable(name="ImageTags",
     *      joinColumns={@ORM\JoinColumn(name="tagid", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="imageid", referencedColumnName="id")}
     *      )
     */
    private $tags;
    public function getTags() { return $this->tags; }



    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ImageInformation", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="imageid")
     */

    private $information;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", mappedBy="objects")
     * @ORM\JoinTable(name="ImageRelations",
     *      joinColumns={@ORM\JoinColumn(name="object", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="subject", referencedColumnName="id")}
     *      )
     */
    private $objects;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", mappedBy="subjects")
     * @ORM\JoinTable(name="ImageRelations",
     *      joinColumns={@ORM\JoinColumn(name="subject", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="object", referencedColumnName="id")}
     *      )
     */
    private $subjects;

    // ...


    /**
     * @ ORM\OneToMany(targetEntity="App\Entity\ImageRelations")
     * @ ORM\JoinColumn(name="id", referencedColumnName="subject")

    private $subjects; // subjectOf
     */

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ImageMetadata", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="imageid", nullable=true)
     */

    private $meta;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ImageHistory", fetch="EAGER")
     * @ORM\JoinColumn(name="id", referencedColumnName="imageid")
     */

    private $history;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ImagePositions")
     * @ORM\JoinColumn(name="id", referencedColumnName="imageid")
     */

    private $location;

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     * @return Image
     */
    public function setLocation($location)
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
        return $this->getInfo() ? substr($this->getInfo()->getFormat(), 0, 3) === 'RAW' : true;
    }


    public function getAlbum(): Albums { return $this->album; }

/**
* @ORM\Column(type="string", name="name")
*/
private $name;

    public function getName() { return $this->name; }

/**
* @ORM\Column(type="integer", name="status")
*/
private $status;

    public function getStatus() { return $this->status; }

/**
* @ORM\Column(type="integer", name="category")
*/
private $category;

    public function getCategory() { return $this->category; }

/**
* @ORM\Column(type="datetime", name="modificationDate")
*/
private $modificationDate;

    public function getModificationdate() { return $this->modificationDate; }

/**
* @ORM\Column(type="integer", name="fileSize")
*/
private $fileSize;

    public function getFilesize() { return $this->fileSize; }

/**
* @ORM\Column(type="text", name="uniqueHash")
*/
private $uniqueHash;

    public function getUniquehash() { return $this->uniqueHash; }


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
     * @param mixed $information
     * @return Image
     */
    public function setInformation($information)
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
     * @param mixed $history
     * @return Image
     */
    public function setHistory($history)
    {
        $this->history = $history;
        return $this;
    }


public function getUrlPath()
{
    return sprintf("%s/%s", $this->getAlbum()->getPath(), $this->getName());
}

    public function getFilePath()
    {
        return $this->getAlbum()->getAlbumroot()->getSpecificpath() . '/' . $this->getAlbum()->getRelativepath() . '/' . $this->getName();
    }

    public function getUniqueIdentifiers() {
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
     * @param mixed $objects
     * @return Image
     */
    public function setObjects($objects)
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
     * @param mixed $subjects
     * @return Image
     */
    public function setSubjects($subjects)
    {
        $this->subjects = $subjects;
        return $this;
    }



}