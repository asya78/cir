<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Hall
 *
 * @ORM\Table(name="halls")
 * @ORM\Entity(repositoryClass="CirTuSofiaBundle\Repository\HallRepository")
 */
class Hall
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var int
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var int
     *
     * @ORM\Column(name="computers", type="integer")
     */
    private $computers;

    /**
     * @var bool
     *
     * @ORM\Column(name="laptop", type="boolean")
     */
    private $laptop;

    /**
     * @var bool
     *
     * @ORM\Column(name="projector", type="boolean")
     */
    private $projector;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="text")
     */
    private $info;

    /**
     * @ORM\Column(name="image", type="string", nullable=false)
     * @var string
     */
    private $image;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\User",inversedBy="halls")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    private $user;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CirTuSofiaBundle\Entity\RequestHall",mappedBy="hall")
     */
    private $requests;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CirTuSofiaBundle\Entity\Problem",mappedBy="hall")
     */
    private $problems;

    public function __construct()
    {
        $this->requests = new ArrayCollection();

        $this->problems = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set number
     *
     * @param string $number
     *
     * @return Hall
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set seats
     *
     * @param integer $seats
     *
     * @return Hall
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return int
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * Set computers
     *
     * @param integer $computers
     *
     * @return Hall
     */
    public function setComputers($computers)
    {
        $this->computers = $computers;

        return $this;
    }

    /**
     * Get computers
     *
     * @return int
     */
    public function getComputers()
    {
        return $this->computers;
    }

    /**
     * Set laptop
     *
     * @param boolean $laptop
     *
     * @return Hall
     */
    public function setLaptop($laptop)
    {
        $this->laptop = $laptop;

        return $this;
    }

    /**
     * Get laptop
     *
     * @return bool
     */
    public function getLaptop()
    {
        return $this->laptop;
    }

    /**
     * Set projector
     *
     * @param boolean $projector
     *
     * @return Hall
     */
    public function setProjector($projector)
    {
        $this->projector = $projector;

        return $this;
    }

    /**
     * Get projector
     *
     * @return bool
     */
    public function getProjector()
    {
        return $this->projector;
    }

    /**
     * Set info
     *
     * @param string $info
     *
     * @return Hall
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     * @return Hall
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }
    /**
     * @return ArrayCollection
     */
    public function getRequests()
    {
        return $this->requests;

    }

}

