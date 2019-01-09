<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Problem
 *
 * @ORM\Table(name="problems")
 * @ORM\Entity(repositoryClass="CirTuSofiaBundle\Repository\ProblemRepository")
 */
class Problem
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="hallId", type="integer")
     */
    private $hallId;

    /**
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\Hall",inversedBy="problems")
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
     * @ORM\ManyToOne(targetEntity="CirTuSofiaBundle\Entity\User",inversedBy="problems")
     * @ORM\JoinColumn(name="requesterId",referencedColumnName="id")
     */
    private $requester;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string")
     */
    private $status;

    public function __construct()
    {

        $this->status = 'Неизпълнена';

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
     * Set description
     *
     * @param string $description
     *
     * @return Problem
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
     * @return int
     */
    public function getHallId()
    {
        return $this->hallId;
    }

    /**
     * @param int $hallId
     * @return Problem
     */
    public function setHallId($hallId)
    {
        $this->hallId = $hallId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHall()
    {
        return $this->hall;
    }

    /**
     * @param mixed $hall
     * @return Problem
     */
    public function setHall($hall)
    {
        $this->hall = $hall;

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
     * @param int $requesterId
     * @return Problem
     */
    public function setRequesterId($requesterId)
    {
        $this->requesterId = $requesterId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequester()
    {
        return $this->requester;
    }

    /**
     * @param mixed $requester
     * @return Problem
     */
    public function setRequester($requester)
    {
        $this->requester = $requester;
        return $this;
    }
}

