<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource()
 */

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRootsRepository")
* @ORM\Table(name="AlbumRoots")
*/
class AlbumRoots extends BaseEntity
{

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Albums", mappedBy="albumRoot")
     */
    private $albums;

    /**
     * @return Collection|Albums[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    /**
     * @param mixed $albums
     * @return AlbumRoots
     */
    public function setAlbums($albums)
    {
        $this->albums = $albums;
        return $this;
    }


/**
* @ORM\Column(type="integer", name="id")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $id;

    public function getId() { return $this->id; }

/**
* @ORM\Column(type="text", name="label")
*/
private $label;

    public function getLabel() { return $this->label; }

/**
* @ORM\Column(type="integer", name="status")
*/
private $status;

    public function getStatus() { return $this->status; }

/**
* @ORM\Column(type="integer", name="type")
*/
private $type;

    public function getType() { return $this->type; }

/**
* @ORM\Column(type="text", name="identifier")
*/
private $identifier;

    public function getIdentifier() { return $this->identifier; }

/**
* @ORM\Column(type="text", name="specificPath")
*/
private $specificPath;

    public function getSpecificpath() { return $this->specificPath; }


public function __toString(): string
{
      return $this->getSpecificpath();
}

    public function getUniqueIdentifiers() {
        return [
            'albumRootId' => $this->getId()
        ];
    }



}