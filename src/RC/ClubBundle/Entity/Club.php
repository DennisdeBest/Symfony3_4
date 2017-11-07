<?php

namespace RC\ClubBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use RC\CoreBundle\Entity\AddressTrait;
use RC\CoreBundle\Entity\BlameableInterface;
use RC\CoreBundle\Entity\BlameableTrait;
use RC\CoreBundle\Entity\TimestampableInterface;
use RC\CoreBundle\Entity\TimestampableTrait;
use RC\CoreBundle\Entity\ToggleableInterface;
use RC\CoreBundle\Entity\ToggleableTrait;
use RC\CoreBundle\Entity\UuidInterface;
use RC\CoreBundle\Entity\UuidTrait;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Club
 *
 * @ORM\Table(name="club")
 * @ORM\Entity(repositoryClass="RC\ClubBundle\Repository\ClubRepository")
 */
class Club implements ResourceInterface, UuidInterface, ToggleableInterface, BlameableInterface, TimestampableInterface
{
    use UuidTrait, AddressTrait, ToggleableTrait, BlameableTrait, TimestampableTrait;
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     */
    private $website;

    /**
     * @ORM\ManyToOne(targetEntity="RC\CustomerBundle\Entity\Customer", inversedBy="clubs")
     * @ORM\JoinColumn(name="customer_id", referencedColumnName="id")
     */
    private $customer;

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
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
     * Set name
     *
     * @param string $name
     *
     * @return Club
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return Club
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }
}

