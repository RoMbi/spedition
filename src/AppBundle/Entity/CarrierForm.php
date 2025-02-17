<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Class CarrierForm
 *
 * @ORM\Table(name="ca_carrier_form")
 * @ORM\Entity()
 * @UniqueEntity(fields = "carrierName")
 * @UniqueEntity(fields = "carrierIdentifier")
 */
class CarrierForm
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
     * @ORM\Column(name="carrierName", type="string", length=255, unique=true)
     */
    private $carrierName;

    /**
     * @var string
     *
     * @ORM\Column(name="carrierIdentifier", type="string", length=255, unique=true)
     */
    private $carrierIdentifier;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=32, unique=true)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="processed", type="integer", options={"default" : 0})
     */
    private $processed = 0;

    /**
     * @var Carrier
     *
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="cars", cascade={"persist"})
     * @ORM\JoinColumn(name="carrier", referencedColumnName="id", onDelete="CASCADE")
     */
    private $carrier;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrierName()
    {
        return $this->carrierName;
    }

    /**
     * @param string $carrierName
     * @return $this
     */
    public function setCarrierName($carrierName)
    {
        $this->carrierName = $carrierName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrierIdentifier()
    {
        return $this->carrierIdentifier;
    }

    /**
     * @param string $carrierIdentifier
     * @return $this
     */
    public function setCarrierIdentifier($carrierIdentifier)
    {
        $this->carrierIdentifier = $carrierIdentifier;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function isProcessed()
    {
        return $this->processed;
    }

    /**
     * @param int $processed
     * @return $this
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
        return $this;
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
    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * Generate md5 code from Class
     * Can be generated only once
     */
    public function generateCode()
    {
        if(!$this->code){
            $this->code = md5($this->__toString());
        }
    }

    /**
     * Regenerate md5 code from Class
     * Used when "normal" code is duplicated
     */
    public function regenerateCode()
    {
        if($this->code){
            $this->code = md5($this->__toString() . mt_rand(0,100));
        }
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->id . $this->carrierName . $this->carrierIdentifier . $this->processed;
    }
}