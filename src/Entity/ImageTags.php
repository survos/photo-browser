<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="ImageTags")
*/
class ImageTags
{

/**
* @ORM\Column(type="integer", name="imageid")
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="integer", name="tagid")
*/
private $tagid;

    public function getTagid() { return $this->tagid; }


public function __toString(): string
{
      return $this->name;
}
}