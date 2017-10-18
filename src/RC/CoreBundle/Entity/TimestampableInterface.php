<?php

namespace RC\CoreBundle\Entity;

interface TimestampableInterface
{
    /**
     * Set dateCreated
     *
     * @param DateTime $dateCreated
     *
     * @return static
     */
    public function setDateCreated($date);

    /**
     * Get dateCreated
     *
     * @return DateTime $dateCreated
     */
    public function getDateCreated();

    /**
     * Set dateUpdated
     *
     * @param DateTime $dateUpdated
     *
     * @return static
     */
    public function setDateUpdated($date);

    /**
     * Get dateUpdated
     *
     * @return DateTime $dateUpdated
     */
    public function getDateUpdated();
}
