<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Carrier
 *
 * @ORM\Table(name="ca_carrier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarrierRepository")
 * @UniqueEntity(fields = "name")
 * @UniqueEntity(fields = "identifier")
 */
class Carrier
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="person", type="string", length=255, nullable=true)
     */
    private $person;

    /**
     * @var string
     *
     * @ORM\Column(name="identifier", type="string", length=255, unique=true, nullable=true)
     */
    private $identifier;

    /**
     * @var string
     * @ORM\Column(name="base", type="string", length=20, nullable=true)
     */
    private $base;

    /**
     * @var Relation[]
     * @ORM\OneToMany(targetEntity="Relation", mappedBy="carrier", cascade={"persist", "remove"})
     */
    private $relations;

    /**
     * @var Car[]
     * @ORM\OneToMany(targetEntity="Car", mappedBy="carrier", cascade={"persist", "remove"})
     */
    private $cars;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="phone", type="bigint", length=15, nullable=true)
     */
    private $phone;

    /**
     * @ORM\ManyToMany(targetEntity="Clause")
     * @ORM\JoinTable(name="ca_carriers_clauses",
     *      joinColumns={@ORM\JoinColumn(name="carrier_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="clause_id", referencedColumnName="id")}
     *      )
     */
    private $clauses;

    /**
     * @var int
     * @ORM\Column(name="status", type="integer", length=4, nullable=true)
    */
    private $status;

    /**
     * @var string
     * @ORM\Column(name="creatorName", type="string", length=255, nullable=true)
     */
    private $createdBy;

    /**
     * @var DateTime
     * @ORM\Column(name="createdAt", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var CarrierTag[]
     * @ORM\ManyToMany(targetEntity="CarrierTag")
     * @ORM\JoinTable(name="ca_carriers_tags",
     *      joinColumns={@ORM\JoinColumn(name="carrier_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
        $this->relations = new ArrayCollection();
        $this->tags = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Carrier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set person
     *
     * @param string $person
     *
     * @return Carrier
     */
    public function setPerson($person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return string
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set identifier
     *
     * @param string $identifier
     *
     * @return Carrier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;

        return $this;
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @param string $base
     * @return Carrier
     */
    public function setBase($base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * @return ArrayCollection|Relation[]
     */
    public function getRelations()
    {
        return $this->relations;
    }

    /**
     * @param Relation $relations
     * @return Carrier
     */
    public function setRelations($relations)
    {
        $this->relations = $relations;
        return $this;
    }

    /**
     * @return ArrayCollection|Car[]
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param Car $cars
     * @return Carrier
     */
    public function setCars($cars)
    {
        $this->cars = $cars;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Carrier
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @param Relation $relation
     * @return $this
     */
    public function addRelation(Relation $relation)
    {
        $this->relations->add($relation);
        return $this;
    }

    /**
     * @param Relation $relation
     * @return $this
     */
    public function removeRelation(Relation $relation)
    {
        $this->relations->removeElement($relation);
        return $this;
    }

    /**
     * @param Car $car
     * @return $this
     */
    public function addCar(Car $car)
    {
        $this->cars->add($car);
        return $this;
    }
    /**
     * @param Car $car
     * @return $this
     */
    public function removeCar(Car $car)
    {
        $this->cars->removeElement($car);
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClauses()
    {
        return $this->clauses;
    }

    /**
     * @param mixed $clauses
     * @return $this
     */
    public function setClauses($clauses)
    {
        $this->clauses = $clauses;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Set creatorName
     *
     * @param string $createdBy
     *
     * @return Carrier
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;
        return $this;
    }

    /**
     * Get creatorName
     *
     * @return string
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return CarrierTag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param CarrierTag $tag
     */
    public function addTag($tag)
    {
        $this->tags->add($tag);
    }
}

