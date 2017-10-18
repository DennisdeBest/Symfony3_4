<?php

namespace RC\CoreBundle\Entity;

interface UuidInterface
{
    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return static
     */
    public function setUuid($uuid);

    /**
     * Get uuid
     *
     * @return string $uuid
     */
    public function getUuid();
}
