<?php

namespace RC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

trait ToggleableTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(name="isEnabled", type="boolean")
     */
    protected $isEnabled = true;

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function isEnabled()
    {
        return $this->isEnabled;
    }

    /**
     * {@inheritDoc}
     *
     * @param boolean $enabled
     *
     * @return static
     */
    public function setEnabled($isEnabled)
    {
        $this->isEnabled = (bool) $isEnabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled()
    {
        return $this->isEnabled;
    }

    public function enable()
    {
        $this->isEnabled = true;
    }

    public function disable()
    {
        $this->isEnabled = false;
    }
}
