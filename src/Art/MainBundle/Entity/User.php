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
     * @var int
     * @ORM\Column(name = "age", type = "integer", nullable = true)
     */
    protected $age;

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
     * @var bool
     * @ORM\Column(name = "education", type = "boolean", nullable = true)
     */
    protected $education;

    /**
     * @var string
     * @ORM\Column(name = "email", type = "string", nullable = true)
     */
    protected $email;

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
     * @var string
     * @ORM\Column(name = "nickname", type = "string", nullable = true)
     */
    protected $nickname;

    /**
     * @var bool
     * @ORM\Column(name = "oil", type = "boolean", nullable = true)
     */
    protected $oil;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity = "Art\MainBundle\Entity\Picture")
     * @ORM\JoinTable(name = "user_self",
     *   joinColumns = {@ORM\JoinColumn(name = "userid", referencedColumnName = "id")},
     *   inverseJoinColumns = {@ORM\JoinColumn(name = "pictureid", referencedColumnName = "id")}
     * )
     */
    protected $self;

    /**
     * @var string
     * @ORM\Column(name = "sex", type = "string", nullable = true)
     */
    protected $sex;

    /**
     * @var Mark[]
     * @ORM\OneToMany(targetEntity = "Art\MainBundle\Entity\Mark", mappedBy = "user")
     */
    protected $marks;

    public function __construct()
    {
        parent::__construct();

        $this->like = new ArrayCollection();
        $this->dislike = new ArrayCollection();
        $this->self = new ArrayCollection();
        $this->sex = 'male';
        $this->oil = false;
        $this->age = 18;
        $this->education = false;
    }

    public function getAge() { return $this->age; }
    public function getDislike() { return $this->dislike; }
    public function getEducation() { return $this->education; }
    public function getEmail() { return $this->email; }
    public function getLike() { return $this->like; }
    public function getNickname() { return $this->nickname; }
    public function getOil() { return $this->oil; }
    public function getSelf() { return $this->self; }
    public function getSex() { return $this->sex; }
    public function getMarks() { return $this->marks; }

    public function setAge($age) { $this->age = $age; return $this; }
    public function setEducation($education) { $this->education = $education; return $this; }
    public function setEmail($email) { $this->email = $email; return $this; }
    public function setNickname($nickname) { $this->nickname = $nickname; return $this; }
    public function setOil($oil) { $this->oil = $oil; return $this; }
    public function setSex($sex) { $this->sex = $sex; return $this; }
} 