<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
* @ORM\Table(name="Settings")
*/
class Settings
{

/**
* @ORM\Column(type="text", name="keyword")
 * @ORM\Id()
*/
private $keyword;

    public function getKeyword() { return $this->keyword; }

/**
* @ORM\Column(type="text", name="value")
*/
private $value;

    public function getValue() { return $this->value; }


public function __toString(): string
{
      return sprintf("%s: %s", $this->getKeyword(), $this->getValue());
}
}