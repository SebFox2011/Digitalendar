<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\City;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $cityRennes = new City();
        $cityRennes->setName("Carrhaix");
        $this->setReference("Carrhaix", $cityRennes);

        $manager->persist($cityRennes);

        $cityNantes = new City();
        $cityNantes->setName("Nantes");
        $this->setReference("Nantes", $cityNantes);

        $manager->persist($cityNantes);

        $cityParis = new City();
        $cityParis->setName("Paris");
        $this->setReference("Paris", $cityParis);

        $manager->persist($cityParis);

        $manager->flush();
    }
}
