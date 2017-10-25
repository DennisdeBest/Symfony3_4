<?php

namespace RC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait UuidTrait
{
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="guid", unique=true)
     */
    protected $uuid;

    /**
     * Set UUID
     *
     * @param  String $uuid
     * @return this
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get UUID
     *
     * @return String $uuid
     */
    public function getUuid()
    {
        return $this->uuid;
    }
}
