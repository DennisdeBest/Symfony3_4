<?php


namespace RC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


trait AddressTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="place_id", type="string", length=255, nullable=true)
     *
     * @Assert\Expression(
     *     "not(this.getAddress() == null) and this.getPlaceId() == null",
     *     message="Address not valid"
     * )
     */
    protected $place_id;


    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return AddressTrait
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPlaceId()
    {
        return $this->place_id;
    }

    /**
     * @param string $place_id
     */
    public function setPlaceId(string $place_id)
    {
        $this->place_id = $place_id;
    }

}