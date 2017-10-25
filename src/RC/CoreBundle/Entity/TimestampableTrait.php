<?php

namespace RC\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait TimestampableTrait
{
    /**
     * @var \DateTime $dateCreated
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="date_created", type="datetime")
     */
    private $dateCreated;

    /**
     * @var \DateTime $dateUpdated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="date_updated", type="datetime")
     */
    private $dateUpdated;

    /**
     * {@inheritdoc}
     *
     * @param DateTime $dateCreated
     *
     * @return static
     */
    public function setDateCreated($date)
    {
        $this->dateCreated = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return DateTime $dateCreated
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * {@inheritdoc}
     *
     * @param DateTime $dateUpdated
     *
     * @return static
     */
    public function setDateUpdated($date)
    {
        $this->dateUpdated = $date;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return DateTime $dateUpdated
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }
}
