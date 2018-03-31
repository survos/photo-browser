<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\ImageMetadataRepository")
* @ORM\Table(name="ImageMetadata")
*/
class ImageMetadata
{

/**
* @ ORM\Column(type="integer", name="imageid")
* @ ORM\Id
* @ ORM\GeneratedValue
private $imageid;

    public function getImageid() { return $this->imageid; }
 */

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="meta")
     * @ORM\JoinColumn(name="imageid", referencedColumnName="id")
     * @ORM\Id
     */
    private $image;

/**
* @ORM\Column(type="text", name="make")
*/
private $make;

    public function getMake() { return $this->make; }

/**
* @ORM\Column(type="text", name="model")
*/
private $model;

    public function getModel() { return $this->model; }

/**
* @ORM\Column(type="text", name="lens")
*/
private $lens;

    public function getLens() { return $this->lens; }

/**
* @ORM\Column(type="float", name="aperture")
*/
private $aperture;

    public function getAperture() { return $this->aperture; }

/**
* @ORM\Column(type="float", name="focalLength")
*/
private $focalLength;

    public function getFocallength() { return $this->focalLength; }

/**
* @ORM\Column(type="float", name="focalLength35")
*/
private $focalLength35;

    public function getFocallength35() { return $this->focalLength35; }

/**
* @ORM\Column(type="float", name="exposureTime")
*/
private $exposureTime;

    public function getExposuretime() { return $this->exposureTime; }

/**
* @ORM\Column(type="integer", name="exposureProgram")
*/
private $exposureProgram;

    public function getExposureprogram() { return $this->exposureProgram; }

/**
* @ORM\Column(type="integer", name="exposureMode")
*/
private $exposureMode;

    public function getExposuremode() { return $this->exposureMode; }

/**
* @ORM\Column(type="integer", name="sensitivity")
*/
private $sensitivity;

    public function getSensitivity() { return $this->sensitivity; }

/**
* @ORM\Column(type="integer", name="flash")
*/
private $flash;

    public function getFlash() { return $this->flash; }

/**
* @ORM\Column(type="integer", name="whiteBalance")
*/
private $whiteBalance;

    public function getWhitebalance() { return $this->whiteBalance; }

/**
* @ORM\Column(type="integer", name="whiteBalanceColorTemperature")
*/
private $whiteBalanceColorTemperature;

    public function getWhitebalancecolortemperature() { return $this->whiteBalanceColorTemperature; }

/**
* @ORM\Column(type="integer", name="meteringMode")
*/
private $meteringMode;

    public function getMeteringmode() { return $this->meteringMode; }

/**
* @ORM\Column(type="float", name="subjectDistance")
*/
private $subjectDistance;

    public function getSubjectdistance() { return $this->subjectDistance; }

/**
* @ORM\Column(type="integer", name="subjectDistanceCategory")
*/
private $subjectDistanceCategory;

    public function getSubjectdistancecategory() { return $this->subjectDistanceCategory; }


public function __toString(): string
{
    $exposure = 1 / $this->getExposuretime();
      return sprintf("ISO-%s 1/%d F%s", $this->getSensitivity(),
          round($exposure),
          $this->getAperture());
}

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     * @return ImageMetadata
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }



}