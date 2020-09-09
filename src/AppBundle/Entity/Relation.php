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
     * @ORM\ManyToMany(targetEntity="Location")
     * @ORM\JoinTable(name="ca_relations_from_locations",
     *      joinColumns={@ORM\JoinColumn(name="relation_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="location_id", referencedColumnName="id")}
     *      )
     */
    private $fromLocations;

    /**
     * @ORM\ManyToMany(targetEntity="Location")
     * @ORM\JoinTable(name="ca_relations_destination_locations",
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
        $this->fromLocations = new ArrayCollection();
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
     * @return Location[]|ArrayCollection
     */
    public function getFromLocations()
    {
        return $this->fromLocations;
    }

    /**
     * @param Location[]|ArrayCollection $fromLocations
     * @return $this
     */
    public function setFromLocations($fromLocations)
    {
        $this->fromLocations = $fromLocations;
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
     * @param Location[]|ArrayCollection $destinations
     * @return $this
     */
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;
        return $this;
    }
}

