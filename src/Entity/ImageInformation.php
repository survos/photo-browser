<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageInformationRepository")
* @ORM\Table(name="ImageInformation")
*/
class ImageInformation
{

    /**
     * @ORM\Column(type="integer", name="imageid")
     * @ORM\Id()
     */

    private $imageid;

    /**
     * @return mixed
     */
    public function getImageid()
    {
        return $this->imageid;
    }

    /**
     * @param mixed $imageid
     * @return ImageInformation
     */
    public function setImageid($imageid)
    {
        $this->imageid = $imageid;
        return $this;
    }

/**
* @ORM\Column(type="integer", name="rating")
*/
private $rating;

    public function getRating() { return $this->rating; }

/**
* @ORM\Column(type="datetime", name="creationDate")
*/
private $creationDate;

    public function getCreationdate() { return $this->creationDate; }

/**
* @ORM\Column(type="datetime", name="digitizationDate")
*/
private $digitizationDate;

    public function getDigitizationdate() { return $this->digitizationDate; }

/**
* @ORM\Column(type="integer", name="orientation")
*/
private $orientation;

    public function getOrientation() { return $this->orientation; }

/**
* @ORM\Column(type="integer", name="width")
*/
private $width;

    public function getWidth() { return $this->width; }

/**
* @ORM\Column(type="integer", name="height")
*/
private $height;

    public function getHeight() { return $this->height; }

/**
* @ORM\Column(type="text", name="format")
*/
private $format;

    public function getFormat() { return $this->format; }

/**
* @ORM\Column(type="integer", name="colorDepth")
*/
private $colorDepth;

    public function getColordepth() { return $this->colorDepth; }

/**
* @ORM\Column(type="integer", name="colorModel")
*/
private $colorModel;

    public function getColormodel() { return $this->colorModel; }


public function __toString(): string
{
      return sprintf("%dx%d, R%s, %s", $this->getHeight(), $this->getWidth(), $this->getRating(), $this->getFormat());
}
}