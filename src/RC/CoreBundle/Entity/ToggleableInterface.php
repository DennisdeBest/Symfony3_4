<?php

namespace RC\CoreBundle\Entity;

interface ToggleableInterface
{
    /**
     * Test if the entity is enabled
     *
     * @return bool
     */
    public function isEnabled();

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return static
     */
    public function setEnabled($enabled);

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled();

    public function enable();

    public function disable();
}
