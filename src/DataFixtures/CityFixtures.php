<?php

namespace App\DataFixtures;

use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new City();
        $test ->setName("Rennes");
        $test ->setCodePostal("35700");
        $manager->persist($test);

        $test2 = new City();
        $test2 ->setName("Rennes");
        $test2 ->setCodePostal("35200");
        $manager->persist($test2);

        $test3 = new City();
        $test3 ->setName("Rennes");
        $test3 ->setCodePostal("35000");
        $manager->persist($test3);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CityFixtures::class
        ];
    }
}
