<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\EventUnit;
use App\Entity\Log;
use App\Entity\Ticket;
use App\Entity\Unit;
use App\Entity\User;
use App\Enum\EventType;
use App\Enum\MissionType;
use App\Enum\TicketStatut;
use App\Enum\UnitType;
use App\Enum\UserGroup;
use App\Enum\UserType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasher $passwordHasher;

    /**
     * @param UserPasswordHasher $passwordHasher
     */
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1
            ->setFirstName("Arthur")
            ->setLastName("Remoussin")
            ->setEmail("arhur.remousin77@gmail.com")
            ->setPhoneNumber("0123456789")
            ->setUserGroup(UserGroup::ZONE1)
            ->setUserType(UserType::SUPERADMIN)
            ->setPassword($this->passwordHasher->hashPassword($user1, "EnClaire"));

        $manager
            ->persist($user1);

        $user2 = new User();
        $user2
            ->setFirstName("Bilel")
            ->setLastName("SLAÏM")
            ->setEmail("blel.slam@gmail.com")
            ->setPhoneNumber("0987654321")
            ->setUserGroup(UserGroup::ZONE4)
            ->setUserType(UserType::ADMIN)
            ->setPassword($this->passwordHasher->hashPassword($user2, "EnSombre"));

        $manager
            ->persist($user2);

        $ticket1 = new Ticket();
        $ticket1
            ->setCity("Paris")
            ->setStatus(TicketStatut::ATTENTE)
            ->setMissionType(MissionType::MISSION_1)
            ->setUnitRequested(3)
            ->setCreatedAt(new \DateTime())
            ->setLastUpdate(new \DateTime())
            ->setDepartment("Paris")
            ->setDescription("Emeutes sur Paris.")
            ->setPostalCode(75001);
        $manager
            ->persist($ticket1);

        $ticket2 = new Ticket();
        $ticket2
            ->setCity("Montpellier")
            ->setStatus(TicketStatut::AFFECTE)
            ->setMissionType(MissionType::MISSION_3)
            ->setUnitRequested(6)
            ->setCreatedAt(new \DateTime())
            ->setLastUpdate(new \DateTime())
            ->setDepartment("Hérault")
            ->setDescription("Patrouille dans une fête foraine")
            ->setPostalCode(34000);
        $manager
            ->persist($ticket2);

        $log1 = new Log();
        $log1
            ->setAction("Modification du ticket")
            ->setDateHour(new \DateTime())
            ->setNewValue("75010")
            ->setOldValue("75011")
            ->setUser($user2);

        $manager
            ->persist($log1);

        $log2 = new Log();
        $log2
            ->setAction("Connexion")
            ->setDateHour(new \DateTime())
            ->setNewValue(NULL)
            ->setOldValue(NULL)
            ->setUser($user1);

        $manager
            ->persist($log2);

        $event = new Event();
        $event
            ->setTicket($ticket1)
            ->setEndDate(new \DateTime)
            ->setStartDate(new \DateTime)
            ->setType(EventType::TICKET)
            ->setUser($user1);

        $manager
            ->persist($event);

        $crs1 = new Unit();
        $crs1
            ->setName("CRS-1")
            ->setUnitType(UnitType::CRS);

        $manager
            ->persist($crs1);

        $eventUnit = new EventUnit();
        $eventUnit
            ->setEvent($event)
            ->setUnit($crs1)
            ->setReassign(true)
            ->setReassignFrom($event);

        $manager
            ->persist($eventUnit);

        $manager
            ->flush();
    }
}
