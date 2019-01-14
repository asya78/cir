<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(
     *     message="Моля попълнете полето 'Име на зала'"
     * )
     * @Assert\Regex(
     *     pattern="^[A-Z0-9]{4}$",
     *     match="true",
     *     message="Невалидно име на зала - само големи букви и цифри, до 4 символа."
     * )
     * @ORM\Column(name="number", type="string", length=255, unique=true)
     */
    private $number;

    /**
     * @var int
     * @Assert\Range(
     *     min=1,
     *     minMessage="Залата може да има най-малко 1 място."
     * )
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var int
     * @Assert\Range(
     *     min=1,
     *     minMessage="Залата може да има най-малко 1 компютър."
     * )
     * @ORM\Column(name="computers", type="integer")
     */
    private $computers;

    /**
     * @var bool
     * @Assert\NotBlank(
     *     message="Моля отбележете има ли възможност за внасяне на лаптоп."
     * )
     * @ORM\Column(name="laptop", type="boolean")
     */
    private $laptop;

    /**
     * @var bool
     * @Assert\NotBlank(
     *     message="Моля отбележете има ли възможност за ползване на проектор."
     * )
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
     * @Assert\
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

    /**
     * @param RequestHall $requestHall
     *
     * @return Hall
     */
    public function addRequest($requestHall)
    {
        $this->requests[] = $requestHall;

        return $this;
    }

}

