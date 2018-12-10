<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Request
 *
 * @ORM\Table(name="requests")
 * @ORM\Entity(repositoryClass="CirTuSofiaBundle\Repository\RequestRepository")
 */
class Request
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeStart", type="time")
     */
    private $timeStart;

    /**
     * @var string
     *
     * @ORM\Column(name="timeEnd", type="string", length=255)
     */
    private $timeEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\OneToOne(targetEntity="CirTuSofiaBundle\Entity\Hall")
     * @ORM\JoinColumn(name="hall_id",referencedColumnName="id")
     */
    private $hall;

    /**
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\User",inversedBy="requests")
     * @ORM\JoinColumn(name="user_id",referencedColumnName="id")
     */
    private $user;


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
     * @return Request
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set timeStart
     *
     * @param \DateTime $timeStart
     *
     * @return Request
     */
    public function setTimeStart($timeStart)
    {
        $this->timeStart = $timeStart;

        return $this;
    }

    /**
     * Get timeStart
     *
     * @return \DateTime
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
     * @return Request
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
     * @return Request
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
}

