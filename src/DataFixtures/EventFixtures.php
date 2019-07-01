<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\Service\Slugger;
use App\Entity\Event;


class EventFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugger;

    public function __construct(Slugger $slugger )
    {
        $this->slugger=$slugger;
    }

    public function load(ObjectManager $manager)
    {
        $EventFestival = new Event();
        $EventFestival->setTitle("West Web Festival");
        $EventFestival->setSlug($this->slugger->slugify($EventFestival->getTitle()));
        $EventFestival->setPicture("build/upload/logo-wwf-2019.png");
        $EventFestival->setDescription("C’est un condensé de digital, de business et de musique à Carhaix,
les 18 et 19 Juillet 2019, pendant le Festival des Vieilles Charrues.");
        $EventFestival->setDateStart(new \DateTime('2019-07-18T10:00:00'));
        $EventFestival->setDateEnd(new \DateTime('2019-07-19T19:00:00'));
        $EventFestival->setUrl("https://www.west-web-festival.fr/");
        $EventFestival->setPrice(205);
        $this->setReference("EventFestival",$EventFestival);
        $EventFestival->setUser($this->getReference('user1'));
        $EventFestival->setCity($this->getReference('Carrhaix'));

        $manager->persist($EventFestival);

        $EventMeeting = new Event();
        $EventMeeting->setTitle("Paris Open Source Summit");
        $EventMeeting->setSlug($this->slugger->slugify($EventMeeting->getTitle()));
        $EventMeeting->setPicture("build/upload/open-source-summit.jpg");
        $EventMeeting->setDescription("Le Paris Open Source Summit est le premier événement en 
        Europe sur l’open source, les logiciels libres et l’innovation ouverte. Sommet international de 
        conférences, salon business et rendez-vous communautaire, OSS Paris met en lumière le rôle moteur 
        des technologies open source dans les transformations numériques actuelles et à venir.");
        $EventMeeting->setDateStart(new \DateTime('2019-12-10T10:00:00'));
        $EventMeeting->setDateEnd(new \DateTime('2019-12-11T19:00:00'));
        $EventMeeting->setUrl("https://www.opensourcesummit.paris/");
        $EventMeeting->setPrice(100);
        $this->setReference("EventMeeting",$EventFestival);
        $EventMeeting->setUser($this->getReference('user2'));
        $EventMeeting->setCity($this->getReference('Paris'));

        $manager->persist($EventMeeting);

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
            UserFixtures::class,
            CityFixtures::class
        ];
    }
}