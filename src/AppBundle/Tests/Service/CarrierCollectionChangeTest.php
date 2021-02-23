<?php

namespace AppBundle\Tests;

use AppBundle\Entity\Car;
use AppBundle\Entity\Carrier;
use AppBundle\Entity\Relation;
use AppBundle\Service\CarrierCollectionChange;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

/**
 * Class CarrierCollectionChangeTest
 */
class CarrierCollectionChangeTest extends TestCase
{
    /**
     * @var EntityManager
     */
    private $em;

    public function setUp()
    {
        $this->em = $this->createMock(EntityManager::class);
    }
    
    public function testRelationRemove()
    {
        $this->em
            ->expects($this->once())
            ->method('remove');
        $carrierCollectionChange = new CarrierCollectionChange($this->em);
        $carrier = new Carrier();
        $relation = new Relation();
        $relation2 = new Relation();
        $carrier->addRelation($relation2);

        $carrierCollectionChange->handleRelations($carrier, new ArrayCollection([$relation, $relation2]));

        self::assertEquals($carrier->getRelations(), (new ArrayCollection([$relation2])));
    }

    public function testRelationCarrierSet()
    {
        $carrierCollectionChange = new CarrierCollectionChange($this->em);
        $carrier = new Carrier();
        $relation = new Relation();
        $carrier->addRelation($relation);

        $carrierCollectionChange->handleRelations($carrier, new ArrayCollection([$relation]));

        foreach ($carrier->getRelations() as $relation) {
            self::assertEquals($carrier, $relation->getCarrier());
        }
    }

    public function testCarRemove()
    {
        $this->em
            ->expects($this->once())
            ->method('remove');
        $carrierCollectionChange = new CarrierCollectionChange($this->em);
        $carrier = new Carrier();
        $car = new Car();
        $car2 = new Car();
        $carrier->addCar($car2);

        $carrierCollectionChange->handleCars($carrier, new ArrayCollection([$car, $car2]));

        self::assertEquals($carrier->getCars(), (new ArrayCollection([$car2])));
        foreach ($carrier->getCars() as $car) {
            self::assertEquals($carrier, $car->getCarrier());
        }
    }

    public function testCarCarrierSet()
    {
        $carrierCollectionChange = new CarrierCollectionChange($this->em);
        $carrier = new Carrier();
        $car = new Car();
        $carrier->addCar($car);

        $carrierCollectionChange->handleCars($carrier, new ArrayCollection());

        foreach ($carrier->getCars() as $car) {
            self::assertEquals($carrier, $car->getCarrier());
        }
    }
}
