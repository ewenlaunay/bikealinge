<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new Order();
        $test -> setReference();
        $test -> setCreationDate();
        $test -> setMeansOfPaiementId();
        $test -> setPrice();
        $test -> setUsersId();
        $manager->persist($test);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CityFixtures::class
        ];
    }
}
