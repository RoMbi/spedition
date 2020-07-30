<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="ca_car")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CarRepository")
 */
class Car
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
     * @ORM\ManyToOne(targetEntity="CarType", cascade={"persist"})
     * @ORM\JoinColumn(name="type", referencedColumnName="id")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="CarBuild", cascade={"persist"})
     * @ORM\JoinColumn(name="build", referencedColumnName="id")
     */
    private $build;

    /**
     * Many Cars have Many eqt
     * @ORM\ManyToMany(targetEntity="CarEquipment")
     * @ORM\JoinTable(name="ca_cars_equipments",
     *      joinColumns={@ORM\JoinColumn(name="car_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipment_id", referencedColumnName="id")}
     *      )
     */
    private $equipments;

    /**
     * @var int
     *
     * @ORM\Column(name="paletteCapacity", type="integer", length=5)
     */
    private $paletteCapacity;

    /**
     * @var int
     *
     * @ORM\Column(name="length", type="integer", length=10)
     */
    private $length;

    /**
     * @var int
     *
     * @ORM\Column(name="width", type="integer", length=10)
     */
    private $width;

    /**
     * @var int
     *
     * @ORM\Column(name="height", type="integer", length=10)
     */
    private $height;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", length=5)
     */
    private $quantity;

    /**
     * @var Carrier
     *
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="cars", cascade={"persist"})
     * @ORM\JoinColumn(name="carrier", referencedColumnName="id")
     */
    private $carrier;


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
     * @param string $type
     *
     * @return Car
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getBuild()
    {
        return $this->build;
    }

    /**
     * @param string $build
     * @return $this
     */
    public function setBuild($build)
    {
        $this->build = $build;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEquipments()
    {
        return $this->equipments;
    }

    /**
     * @param mixed $equipments
     * @return $this
     */
    public function setEquipments($equipments)
    {
        $this->equipments = $equipments;
        return $this;
    }

    /**
     * @return int
     */
    public function getPaletteCapacity()
    {
        return $this->paletteCapacity;
    }

    /**
     * @param int $paletteCapacity
     * @return $this
     */
    public function setPaletteCapacity($paletteCapacity)
    {
        $this->paletteCapacity = $paletteCapacity;
        return $this;
    }

    /**
     * @return int
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * @param int $length
     * @return $this
     */
    public function setLength($length)
    {
        $this->length = $length;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return $this
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return $this
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed $carrier
     * @return Car
     */
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

}

