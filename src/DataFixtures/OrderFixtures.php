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
        $test->setReference('1234');
        $test->setUser();
        $test->setMeanOfPaiement();
        $test->setStatus();
        $test->setPrice('1000');

        $manager->flush();
    }
}
