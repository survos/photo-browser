<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImagePositionsRepository")
* @ORM\Table(name="ImagePositions")
*/
class ImagePositions
{

/**
* @ORM\Column(type="integer", name="imageid")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="text", name="latitude")
*/
private $latitude;

    public function getLatitude() { return $this->latitude; }

/**
* @ORM\Column(type="float", name="latitudeNumber")
*/
private $latitudeNumber;

    public function getLatitudenumber() { return $this->latitudeNumber; }

/**
* @ORM\Column(type="text", name="longitude")
*/
private $longitude;

    public function getLongitude() { return $this->longitude; }

/**
* @ORM\Column(type="float", name="longitudeNumber")
*/
private $longitudeNumber;

    public function getLongitudenumber() { return $this->longitudeNumber; }

/**
* @ORM\Column(type="float", name="altitude")
*/
private $altitude;

    public function getAltitude() { return $this->altitude; }

/**
* @ORM\Column(type="float", name="orientation")
*/
private $orientation;

    public function getOrientation() { return $this->orientation; }

/**
* @ORM\Column(type="float", name="tilt")
*/
private $tilt;

    public function getTilt() { return $this->tilt; }

/**
* @ORM\Column(type="float", name="roll")
*/
private $roll;

    public function getRoll() { return $this->roll; }

/**
* @ORM\Column(type="float", name="accuracy")
*/
private $accuracy;

    public function getAccuracy() { return $this->accuracy; }

/**
* @ORM\Column(type="text", name="description")
*/
private $description;

    public function getDescription() { return $this->description; }


public function __toString(): string
{
      return sprintf("%3.2f,%3.2f", $this->getLatitudenumber(), $this->getLongitudenumber());
}
}