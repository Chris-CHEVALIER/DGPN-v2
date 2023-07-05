<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\EventUnit;
use App\Entity\Unit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    public function addEventUnit(Event $event, Unit $unit)
    {
        $eventUnit = new EventUnit();
        $eventUnit->setEvent($event);
        $eventUnit->setUnit($unit);

        $this->_em->persist($eventUnit);
        $this->_em->flush();
    }


}