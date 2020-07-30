<?php
/**
 * Copyright © 2018 Dawid Grzywa (dawid.grzywa@gmail.com)
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Location;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;

/**
 * CarrierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarrierRepository extends EntityRepository
{
    public function searchByFormData($data)
    {
        $query = $this->createQueryBuilder('c')
            ->leftJoin('c.cars', 'car')
            ->leftJoin('c.relations', 'r')
            ->leftJoin('r.destinations', 'd')
            ->leftJoin('r.fromLocation', 'fromLocation')
            ->leftJoin('car.equipments', 'e');

        if ($data['base']) {
            $query
                ->andWhere('c.base LIKE :base')
                ->setParameter('base', $data['base'] . '%');
        }

        /** @var Location $fromLocation */
        if ($fromLocation = $data['fromLocation']) {
            $query
                ->andWhere('fromLocation.code LIKE :fromLocationLike')
                ->setParameter('fromLocationLike', $fromLocation->getCode() . '%');
        }

        /** @var Location $destination */
        if ($destination = $data['destinations']) {
            $query
                ->andWhere('d.code LIKE :destinationLike')
                ->setParameter('destinationLike', $destination->getCode() . '%');
        }

        if ($data['type']) {
            $query
                ->andWhere('car.type = :type')
                ->setParameter('type', $data['type']);
        }

        if ($data['build']) {
            $query
                ->andWhere('car.build = :build')
                ->setParameter('build', $data['build']);
        }

        /**
         * @var $equipments ArrayCollection
         */
        $equipments = $data['equipments'];
        if ($equipments->count()) {
            $query
                ->andWhere('e.id IN (:equipments)')
                ->setParameter('equipments', $data['equipments']);
        }

        if ($data['paletteCapacityFrom']) {
            $query
                ->andWhere('car.paletteCapacity >= :paletteCapacityFrom')
                ->setParameter('paletteCapacityFrom', $data['paletteCapacityFrom']);
        }

        if ($data['paletteCapacityTo']) {
            $query
                ->andWhere('car.paletteCapacity <= :paletteCapacityTo')
                ->setParameter('paletteCapacityTo', $data['paletteCapacityTo']);
        }

        if ($data['quantity']) {
            $query
                ->andWhere('car.quantity >= :quantity')
                ->setParameter('quantity', $data['quantity']);
        }
        return $query->getQuery()->getResult();
    }
}
