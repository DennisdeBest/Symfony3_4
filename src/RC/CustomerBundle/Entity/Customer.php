<?php

namespace RC\CustomerBundle\Entity;

use RC\UserBundle\Entity\User as BaseUser;
use Sylius\Component\Resource\Model\ResourceInterface;
use RC\CoreBundle\Entity\UuidTrait;
use RC\CoreBundle\Entity\UuidInterface;
use RC\CoreBundle\Entity\TimestampableTrait;
use RC\CoreBundle\Entity\TimestampableInterface;

class Customer extends BaseUser implements ResourceInterface, TimestampableInterface, UuidInterface
{
    use TimestampableTrait, UuidTrait;

    protected $id;

    private $firstname;

    private $lastname;

    private $address;
}