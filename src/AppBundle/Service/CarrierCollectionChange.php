<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */
namespace AppBundle\Service;

use AppBundle\Entity\Car;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\Relation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CarrierCollectionChange - service handling a change on collection types in carrier
 * at this moment Car and Relation collections
 * @package AppBundle\Service
 */
class CarrierCollectionChange
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CarrierCollectionChange constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    /**
     * @param Carrier $carrier
     * @param ArrayCollection $originalRelations
     */
    public function handleRelations(Carrier $carrier, ArrayCollection $originalRelations)
    {
        /**
         * handle new Cars
         */
        foreach ($carrier->getRelations() as $relation) {
            $relation->setCarrier($carrier);
        }

        /**
         * removing deleted cars
         * @var Relation $originalRelation
         */
        foreach ($originalRelations as $originalRelation) {
            if (false === $carrier->getRelations()->contains($originalRelation)) {
                $carrier->removeRelation($originalRelation);
                $this->em->persist($carrier);
                $this->em->remove($originalRelation);
                /** nulling carrier from Car instead of deleting entity */
//                    $originalRelation->setCarrier(null);
            }
        }
        // Create an ArrayCollection of the current Car objects in the database
        foreach ($carrier->getRelations() as $relation) {
            $originalRelations->add($relation);
        }
    }

    /**
     * @param Carrier $carrier
     * @param ArrayCollection $originalCars
     */
    public function handleCars(Carrier $carrier, ArrayCollection $originalCars)
    {
        /**
         * handle new Cars
         */
        foreach ($carrier->getCars() as $car) {
            $car->setCarrier($carrier);
        }

        /**
         * removing deleted cars
         * @var Car $car
         */
        foreach ($originalCars as $car) {
            if (false === $carrier->getCars()->contains($car)) {
                $carrier->removeCar($car);
                $this->em->persist($carrier);
                $this->em->remove($car);
                /** nulling carrier from Car instead of deleting entity */
//                    $car->setCarrier(null);
            }
        }
        // Create an ArrayCollection of the current Car objects in the database
        foreach ($carrier->getCars() as $car) {
            $originalCars->add($car);
        }
    }
}