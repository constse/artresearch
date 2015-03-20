<?php

namespace Art\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package Art\MainBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name = "users")
 */
class User extends AbstractEntity
{
    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity = "Art\MainBundle\Entity\Picture")
     * @ORM\JoinTable(name = "user_like",
     *   joinColumns = {@ORM\JoinColumn(name = "userid", referencedColumnName = "id")},
     *   inverseJoinColumns = {@ORM\JoinColumn(name = "pictureid", referencedColumnName = "id")}
     * )
     */
    protected $like;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity = "Art\MainBundle\Entity\Picture")
     * @ORM\JoinTable(name = "user_dislike",
     *   joinColumns = {@ORM\JoinColumn(name = "userid", referencedColumnName = "id")},
     *   inverseJoinColumns = {@ORM\JoinColumn(name = "pictureid", referencedColumnName = "id")}
     * )
     */
    protected $dislike;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity = "Art\MainBundle\Entity\Picture")
     * @ORM\JoinTable(name = "user_self",
     *   joinColumns = {@ORM\JoinColumn(name = "userid", referencedColumnName = "id")},
     *   inverseJoinColumns = {@ORM\JoinColumn(name = "pictureid", referencedColumnName = "id")}
     * )
     */
    protected $self;

    public function __construct()
    {
        parent::__construct();

        $this->like = new ArrayCollection();
        $this->dislike = new ArrayCollection();
        $this->self = new ArrayCollection();
    }

    public function getLike() { return $this->like; }
    public function getDislike() { return $this->dislike; }
    public function getSelf() { return $this->self; }
} 