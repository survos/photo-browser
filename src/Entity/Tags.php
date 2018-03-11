<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\TagsRepository")
* @ORM\Table(name="Tags")
*/
class Tags
{

/**
* @ORM\Column(type="integer", name="id")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $id;

    public function getId() { return $this->id; }

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Image", inversedBy="tags")
     * @ORM\JoinTable(name="ImageTags",
     *      joinColumns={@ORM\JoinColumn(name="tagid", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="imageid", referencedColumnName="id")}
     *      )
     */

    private $images;
    public function getImages() { return $this->images; }


/**
* @ORM\Column(type="integer", name="pid")
*/
private $pid;



    public function getPid() { return $this->pid; }

/**
* @ORM\Column(type="string", name="name")
*/
private $name;

    public function getName() { return $this->name; }

/**
* @ORM\Column(type="integer", name="icon")
*/
private $icon;

    public function getIcon() { return $this->icon; }

/**
* @ORM\Column(type="text", name="iconkde")
*/
private $iconkde;

    public function getIconkde() { return $this->iconkde; }


public function __toString(): string
{
      return $this->getName();
}
}