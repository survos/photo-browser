<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageHistoryRepository")
* @ORM\Table(name="ImageHistory")
*/
class ImageHistory
{

/**
* @ORM\Column(type="integer", name="imageid")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="text", name="uuid")
*/
private $uuid;

    public function getUuid() { return $this->uuid; }

/**
* @ORM\Column(type="text", name="history")
*/
private $history;

    public function getHistory() { return $this->history; }


public function __toString(): string
{
      return $this->name;
}
}