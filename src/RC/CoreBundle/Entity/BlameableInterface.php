<?php

namespace RC\CoreBundle\Entity;

use RC\UserBundle\Entity\User;

interface BlameableInterface
{
    /**
     * @return User
     */
    public function getCreatedBy();

    /**
     * @param User $createdBy
     */
    public function setCreatedBy(User $createdBy);
    /**
     * @return User
     */
    public function getUpdatedBy();

    /**
     * @param User $updatedBy
     */
    public function setUpdatedBy(User $updatedBy);
}
