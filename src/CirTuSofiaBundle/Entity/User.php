<?php

namespace CirTuSofiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="CirTuSofiaBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="CirTuSofiaBundle\Entity\Hall",mappedBy="user")
     */
    private $halls;


    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="CirTuSofiaBundle\Entity\RequestHall", mappedBy="requester")
     */
    private $requests;

    /**
     * @var ArrayCollection
     * Many Users have Many Roles.
     * @ORM\ManyToMany(targetEntity="CirTuSofiaBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="users_roles")
     *
     */
    private $roles;



    public function __construct()
    {
        $this->halls = new ArrayCollection();

        $this->requests = new ArrayCollection();

        $this->roles = new ArrayCollection();

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
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return array('ROLE_USER');
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        $stringRoles = [];

        /** @var $role Role */
        foreach ($this->roles as $role)
        {
            $stringRoles[] = $role->getRole();
        }

        return $stringRoles;
    }

    /**
     * @param  Role $role
     * @return User
     */
    public function addRole($role)
    {
        $this->roles[] = $role;

        return $this;
    }

    public function isAdmin()
    {
        return in_array("ROLE_ADMIN", $this->getRoles());
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return ArrayCollection
     */
    public function getHalls()
    {
        return $this->halls;
    }

    /**
     * @param \CirTuSofiaBundle\Entity\Hall $hall
     *
     * @return User
     */
    public function addHall($hall)
    {
        $this->halls[] = $hall;

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
     * @param Request $request
     * @return  User
     */
    public function addRequest($request)
    {
        $this->requests[] = $request;

        return $this;
    }
}

