<?php

namespace RC\CustomerBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use RC\CoreBundle\Entity\AddressTrait;
use RC\CoreBundle\Entity\ToggleableInterface;
use RC\CoreBundle\Entity\ToggleableTrait;
use RC\UserBundle\Entity\User as BaseUser;
use Sylius\Component\Resource\Model\ResourceInterface;
use RC\CoreBundle\Entity\UuidTrait;
use RC\CoreBundle\Entity\UuidInterface;
use RC\CoreBundle\Entity\TimestampableTrait;
use RC\CoreBundle\Entity\TimestampableInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="customer")
 * @UniqueEntity(fields="username", targetClass="RC\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "RC\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Customer extends BaseUser implements ResourceInterface, TimestampableInterface, UuidInterface, ToggleableInterface
{
    use TimestampableTrait, UuidTrait, AddressTrait, ToggleableTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="fos_user.firstname.blank")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="fos_user.lastname.blank")
     */
    private $lastname;

    /**
     * @ORM\OneToMany(targetEntity="RC\ClubBundle\Entity\Club", mappedBy="customer")
     */
    private $clubs;

    public function __construct()
    {
        $this->clubs = new ArrayCollection();
        parent::__construct();
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Customer
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Customer
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }


    public function setEmail($email)
    {
        $this->email = $email;
        $this->username = $email;

        return $this;
    }

    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;
        $this->usernameCanonical = $emailCanonical;

        return $this;
    }


    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     *
     * @return Customer
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * Add club
     *
     * @param \RC\ClubBundle\Entity\Club $club
     *
     * @return Customer
     */
    public function addClub(\RC\ClubBundle\Entity\Club $club)
    {
        $this->clubs[] = $club;

        return $this;
    }

    /**
     * Remove club
     *
     * @param \RC\ClubBundle\Entity\Club $club
     */
    public function removeClub(\RC\ClubBundle\Entity\Club $club)
    {
        $this->clubs->removeElement($club);
    }

    /**
     * Get clubs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClubs()
    {
        return $this->clubs;
    }
}
