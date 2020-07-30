<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Relation
 *
 * @ORM\Table(name="ca_relation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RelationRepository")
 */
class Relation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Location
     *
     * @ORM\ManyToOne(targetEntity="Location", cascade={"persist"})
     * @ORM\JoinColumn(name="from_location", referencedColumnName="id")
     */
    private $fromLocation;

    /**
     * @ORM\ManyToMany(targetEntity="Location")
     * @ORM\JoinTable(name="ca_relations_locations",
     *      joinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="location_id", referencedColumnName="id")}
     *      )
     */
    private $destinations;

    /**
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="relations",cascade={"persist"})
     * @ORM\JoinColumn(name="carrier", referencedColumnName="id")
     */
    private $carrier;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Location
     */
    public function getFromLocation()
    {
        return $this->fromLocation;
    }

    /**
     * @param Location $from
     * @return $this
     */
    public function setFromLocation(Location $from)
    {
        $this->fromLocation = $from;
        return $this;
    }

    /**
     * @return Location[]|ArrayCollection
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @return Carrier
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param Carrier $carrier
     * @return $this
     */
    public function setCarrier(Carrier $carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @param $destinations
     * @return $this
     */
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;
        return $this;
    }
}

