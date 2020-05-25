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
        $test ->setName("Rennes 35000");
        $test ->setCp("35700");
        $manager->persist($test);
        $this->addReference('rennescentre', $test);


        $test2 = new City();
        $test2 ->setName("Rennes 35200");
        $test2 ->setCp("35200");
        $manager->persist($test2);

        $test3 = new City();
        $test3 ->setName("Rennes 35700");
        $test3 ->setCp("35000");
        $manager->persist($test3);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CityFixtures::class
        ];
    }
}
