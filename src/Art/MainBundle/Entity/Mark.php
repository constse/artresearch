<?php

namespace Art\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Mark
 * @package Art\MainBundle\Entity
 * @ORM\Entity
 * @ORM\Table(name = "marks")
 */
class Mark extends AbstractEntity
{
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity = "Art\MainBundle\Entity\User", inversedBy = "marks")
     * @ORM\JoinColumn(name = "userid", referencedColumnName = "id")
     */
    protected $user;

    /**
     * @var Picture
     * @ORM\ManyToOne(targetEntity = "Art\MainBundle\Entity\Picture")
     * @ORM\JoinColumn(name = "pictureid", referencedColumnName = "id")
     */
    protected $picture;

    /**
     * @var float
     * @ORM\Column(name = "mark1", type = "float", nullable = true)
     */
    protected $mark1;

    /**
     * @var float
     * @ORM\Column(name = "mark2", type = "float", nullable = true)
     */
    protected $mark2;

    /**
     * @var float
     * @ORM\Column(name = "mark3", type = "float", nullable = true)
     */
    protected $mark3;

    /**
     * @var float
     * @ORM\Column(name = "mark4", type = "float", nullable = true)
     */
    protected $mark4;

    /**
     * @var float
     * @ORM\Column(name = "mark5", type = "float", nullable = true)
     */
    protected $mark5;

    /**
     * @var float
     * @ORM\Column(name = "mark6", type = "float", nullable = true)
     */
    protected $mark6;

    /**
     * @var float
     * @ORM\Column(name = "mark7", type = "float", nullable = true)
     */
    protected $mark7;

    /**
     * @var float
     * @ORM\Column(name = "mark8", type = "float", nullable = true)
     */
    protected $mark8;

    /**
     * @var float
     * @ORM\Column(name = "mark9", type = "float", nullable = true)
     */
    protected $mark9;

    /**
     * @var float
     * @ORM\Column(name = "mark10", type = "float", nullable = true)
     */
    protected $mark10;

    /**
     * @var float
     * @ORM\Column(name = "mark11", type = "float", nullable = true)
     */
    protected $mark11;

    /**
     * @var float
     * @ORM\Column(name = "mark12", type = "float", nullable = true)
     */
    protected $mark12;

    /**
     * @var float
     * @ORM\Column(name = "mark13", type = "float", nullable = true)
     */
    protected $mark13;

    /**
     * @var float
     * @ORM\Column(name = "mark14", type = "float", nullable = true)
     */
    protected $mark14;

    /**
     * @var float
     * @ORM\Column(name = "mark15", type = "float", nullable = true)
     */
    protected $mark15;

    /**
     * @var float
     * @ORM\Column(name = "mark16", type = "float", nullable = true)
     */
    protected $mark16;

    /**
     * @var float
     * @ORM\Column(name = "mark17", type = "float", nullable = true)
     */
    protected $mark17;

    /**
     * @var float
     * @ORM\Column(name = "mark18", type = "float", nullable = true)
     */
    protected $mark18;

    /**
     * @var float
     * @ORM\Column(name = "mark19", type = "float", nullable = true)
     */
    protected $mark19;

    /**
     * @var float
     * @ORM\Column(name = "mark20", type = "float", nullable = true)
     */
    protected $mark20;

    /**
     * @var float
     * @ORM\Column(name = "mark21", type = "float", nullable = true)
     */
    protected $mark21;

    /**
     * @var float
     * @ORM\Column(name = "mark22", type = "float", nullable = true)
     */
    protected $mark22;

    /**
     * @var float
     * @ORM\Column(name = "mark23", type = "float", nullable = true)
     */
    protected $mark23;

    /**
     * @var float
     * @ORM\Column(name = "mark24", type = "float", nullable = true)
     */
    protected $mark24;

    /**
     * @var float
     * @ORM\Column(name = "mark25", type = "float", nullable = true)
     */
    protected $mark25;

    /**
     * @var float
     * @ORM\Column(name = "mark26", type = "float", nullable = true)
     */
    protected $mark26;

    /**
     * @var float
     * @ORM\Column(name = "mark27", type = "float", nullable = true)
     */
    protected $mark27;

    /**
     * @var float
     * @ORM\Column(name = "mark28", type = "float", nullable = true)
     */
    protected $mark28;

    /**
     * @var float
     * @ORM\Column(name = "mark29", type = "float", nullable = true)
     */
    protected $mark29;

    /**
     * @var float
     * @ORM\Column(name = "mark30", type = "float", nullable = true)
     */
    protected $mark30;

    public function __construct()
    {
        parent::__construct();

        $this->mark1 = 5.0;
        $this->mark2 = 5.0;
        $this->mark3 = 5.0;
        $this->mark4 = 5.0;
        $this->mark5 = 5.0;
        $this->mark6 = 5.0;
        $this->mark7 = 5.0;
        $this->mark8 = 5.0;
        $this->mark9 = 5.0;
        $this->mark10 = 5.0;
        $this->mark11 = 5.0;
        $this->mark12 = 5.0;
        $this->mark13 = 5.0;
        $this->mark14 = 5.0;
        $this->mark15 = 5.0;
        $this->mark16 = 5.0;
        $this->mark17 = 5.0;
        $this->mark18 = 5.0;
        $this->mark19 = 5.0;
        $this->mark20 = 5.0;
        $this->mark21 = 5.0;
        $this->mark22 = 5.0;
        $this->mark23 = 5.0;
        $this->mark24 = 5.0;
        $this->mark25 = 5.0;
        $this->mark26 = 5.0;
        $this->mark27 = 5.0;
        $this->mark28 = 5.0;
        $this->mark29 = 5.0;
        $this->mark30 = 5.0;
    }
    
    public function getUser() { return $this->user; }
    public function getPicture() { return $this->picture; }
    public function getMark1() { return $this->mark1; }
    public function getMark2() { return $this->mark2; }
    public function getMark3() { return $this->mark3; }
    public function getMark4() { return $this->mark4; }
    public function getMark5() { return $this->mark5; }
    public function getMark6() { return $this->mark6; }
    public function getMark7() { return $this->mark7; }
    public function getMark8() { return $this->mark8; }
    public function getMark9() { return $this->mark9; }
    public function getMark10() { return $this->mark10; }
    public function getMark11() { return $this->mark11; }
    public function getMark12() { return $this->mark12; }
    public function getMark13() { return $this->mark13; }
    public function getMark14() { return $this->mark14; }
    public function getMark15() { return $this->mark15; }
    public function getMark16() { return $this->mark16; }
    public function getMark17() { return $this->mark17; }
    public function getMark18() { return $this->mark18; }
    public function getMark19() { return $this->mark19; }
    public function getMark20() { return $this->mark20; }
    public function getMark21() { return $this->mark21; }
    public function getMark22() { return $this->mark22; }
    public function getMark23() { return $this->mark23; }
    public function getMark24() { return $this->mark24; }
    public function getMark25() { return $this->mark25; }
    public function getMark26() { return $this->mark26; }
    public function getMark27() { return $this->mark27; }
    public function getMark28() { return $this->mark28; }
    public function getMark29() { return $this->mark29; }
    public function getMark30() { return $this->mark30; }

    public function setUser(User $user) { $this->user = $user; return $this; }
    public function setPicture(Picture $picture) { $this->picture = $picture; return $this; }
    public function setMark1($mark) { $this->mark1 = $mark; return $this; }
    public function setMark2($mark) { $this->mark2 = $mark; return $this; }
    public function setMark3($mark) { $this->mark3 = $mark; return $this; }
    public function setMark4($mark) { $this->mark4 = $mark; return $this; }
    public function setMark5($mark) { $this->mark5 = $mark; return $this; }
    public function setMark6($mark) { $this->mark6 = $mark; return $this; }
    public function setMark7($mark) { $this->mark7 = $mark; return $this; }
    public function setMark8($mark) { $this->mark8 = $mark; return $this; }
    public function setMark9($mark) { $this->mark9 = $mark; return $this; }
    public function setMark10($mark) { $this->mark10 = $mark; return $this; }
    public function setMark11($mark) { $this->mark11 = $mark; return $this; }
    public function setMark12($mark) { $this->mark12 = $mark; return $this; }
    public function setMark13($mark) { $this->mark13 = $mark; return $this; }
    public function setMark14($mark) { $this->mark14 = $mark; return $this; }
    public function setMark15($mark) { $this->mark15 = $mark; return $this; }
    public function setMark16($mark) { $this->mark16 = $mark; return $this; }
    public function setMark17($mark) { $this->mark17 = $mark; return $this; }
    public function setMark18($mark) { $this->mark18 = $mark; return $this; }
    public function setMark19($mark) { $this->mark19 = $mark; return $this; }
    public function setMark20($mark) { $this->mark20 = $mark; return $this; }
    public function setMark21($mark) { $this->mark21 = $mark; return $this; }
    public function setMark22($mark) { $this->mark22 = $mark; return $this; }
    public function setMark23($mark) { $this->mark23 = $mark; return $this; }
    public function setMark24($mark) { $this->mark24 = $mark; return $this; }
    public function setMark25($mark) { $this->mark25 = $mark; return $this; }
    public function setMark26($mark) { $this->mark26 = $mark; return $this; }
    public function setMark27($mark) { $this->mark27 = $mark; return $this; }
    public function setMark28($mark) { $this->mark28 = $mark; return $this; }
    public function setMark29($mark) { $this->mark29 = $mark; return $this; }
    public function setMark30($mark) { $this->mark30 = $mark; return $this; }
} 