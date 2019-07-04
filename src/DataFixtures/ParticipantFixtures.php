<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Participant;

class ParticipantFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $participant1 = new Participant();
        $participant1->setCreatedAt(new \DateTime('2011-01-01T15:03:01'));
        $participant1->setEvent($this->getReference("EventFestival"));
        $participant1->setUser($this->getReference("user1"));

        $manager->persist($participant1);

        $participant2 = new Participant();
        $participant2->setCreatedAt(new \DateTime('2013-01-01T10:03:01'));
        $participant2->setEvent($this->getReference("EventMeeting"));
        $participant2->setUser($this->getReference("user2"));

        $manager->persist($participant2);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            EventFixtures::class,
            UserFixtures::class
        ];
    }
}
