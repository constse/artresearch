<?php

namespace Art\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Picture
 * @package Art\MainBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name = "pictures")
 */
class Picture extends AbstractEntity
{
    /**
     * @var
     * @ORM\Column(name = "number", type = "integer")
     */
    protected $number;

    public function getNumber() { return $this->number; }

    public function setNumber($number) { $this->number = $number; return $this; }
}