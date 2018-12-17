<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

/**
 * RequestHall
 *
 * @ORM\Table(name="requests")
 * @ORM\Entity(repositoryClass="CirTuSofiaBundle\Repository\RequestHallRepository")
 */
class RequestHall
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
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="timeStart", type="time", nullable=true)
     */
    private $timeStart;

    /**
     * @var string
     *
     * @ORM\Column(name="timeEnd", type="time", nullable=true)
     */
    private $timeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="hallId", type="integer")
     */
    private $hallId;

    /**
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\Hall",inversedBy="requests")
     * @ORM\JoinColumn(name="hallId",referencedColumnName="id")
     */
    private $hall;

    /**
     * @var int
     *
     * @ORM\Column(name="requesterId", type="integer")
     */
    private $requesterId;

    /**
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\User",inversedBy="requests")
     * @ORM\JoinColumn(name="requesterId",referencedColumnName="id")
     */
    private $requester;


    public function __construct()
    {

        $this->status = 'Чакаща';

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return RequestHall
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set timeStart
     *
     * @param string $timeStart
     *
     * @return string
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;

    }

    /**
     * Get timeStart
     *
     * @return string
     */
    public function getTimeStart()
    {
        return $this->timeStart;
    }

    /**
     * Set timeEnd
     *
     * @param string $timeEnd
     *
     * @return RequestHall
     */
    public function setTimeEnd($timeEnd)
    {
        $this->timeEnd = $timeEnd;

        return $this;
    }

    /**
     * Get timeEnd
     *
     * @return string
     */
    public function getTimeEnd()
    {
        return $this->timeEnd;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return RequestHall
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;


    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;

    }

    /**
     * @return User $requester
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @param User $requester
     * @return RequestHall
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;

        return $this;
    }

    /**
     * @return Hall
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * @param $hall
     */
    public function setHall($hall)
    {
        $this->hall = $hall;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     * @return RequestHall
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getRequesterId()
    {
        return $this->requesterId;
    }

    /**
     * @param integer $requesterId
     * @return RequestHall
     */
    public function setRequesterId($requesterId)
    {
        $this->requesterId = $requesterId;

        return $this;
    }

    /**
     * @return int
     */
    public function getHallId()
    {
        return $this->hallId;
    }

    /**
     * @param int $hallId
     * @return RequestHall
     */
    public function setHallId($hallId)
    {
        $this->hallId = $hallId;

        return $this;
    }


}

