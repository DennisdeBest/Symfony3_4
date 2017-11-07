<?php

namespace RC\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use RC\UserBundle\Entity\User as BaseUser;
use RC\CoreBundle\Entity\UuidTrait;
use RC\CoreBundle\Entity\UuidInterface;
use RC\CoreBundle\Entity\TimestampableTrait;
use RC\CoreBundle\Entity\TimestampableInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="admin")
 * @UniqueEntity(fields="username", targetClass="RC\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "RC\UserBundle\Entity\User", message="fos_user.email.already_used")
 */
class Admin extends BaseUser implements TimestampableInterface, UuidInterface
{
    use TimestampableTrait, UuidTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
