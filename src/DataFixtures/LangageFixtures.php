<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Langage;

class LangageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $langageFrancais = new Langage();
        $langageFrancais->setName("Français");
        $manager->persist($langageFrancais);

        $langageAnglais = new Langage();
        $langageAnglais->setName("Anglais");
        $manager->persist($langageAnglais);

        $langageAllemand = new Langage();
        $langageAllemand->setName("Allemand");
        $manager->persist($langageAllemand);


        $manager->flush();
    }
}
