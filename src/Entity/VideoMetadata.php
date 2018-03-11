<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\VideoMetadataRepository")
* @ORM\Table(name="VideoMetadata")
*/
class VideoMetadata
{

/**
* @ORM\Column(type="integer", name="imageid")
* @ORM\Id
* @ORM\GeneratedValue
*/
private $imageid;

    public function getImageid() { return $this->imageid; }

/**
* @ORM\Column(type="text", name="aspectRatio")
*/
private $aspectRatio;

    public function getAspectratio() { return $this->aspectRatio; }

/**
* @ORM\Column(type="text", name="audioBitRate")
*/
private $audioBitRate;

    public function getAudiobitrate() { return $this->audioBitRate; }

/**
* @ORM\Column(type="text", name="audioChannelType")
*/
private $audioChannelType;

    public function getAudiochanneltype() { return $this->audioChannelType; }

/**
* @ORM\Column(type="text", name="audioCompressor")
*/
private $audioCompressor;

    public function getAudiocompressor() { return $this->audioCompressor; }

/**
* @ORM\Column(type="text", name="duration")
*/
private $duration;

    public function getDuration() { return $this->duration; }

/**
* @ORM\Column(type="text", name="frameRate")
*/
private $frameRate;

    public function getFramerate() { return $this->frameRate; }

/**
* @ORM\Column(type="integer", name="exposureProgram")
*/
private $exposureProgram;

    public function getExposureprogram() { return $this->exposureProgram; }

/**
* @ORM\Column(type="text", name="videoCodec")
*/
private $videoCodec;

    public function getVideocodec() { return $this->videoCodec; }


public function __toString(): string
{
      return $this->name;
}
}