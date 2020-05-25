<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new Status();
        $test->setLibelle('En cours');
        $manager->persist($test);
        $this->addReference('encours', $test);


        $manager->flush();
    }
}
