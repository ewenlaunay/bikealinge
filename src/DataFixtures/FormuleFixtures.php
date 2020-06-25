<?php

namespace App\DataFixtures;

use App\Entity\Formule;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FormuleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new Formule();
        $test->setLabel('Formule à 12€');
        $test->setPrice(12);
        $manager->persist($test);
        $this->addReference('formule1', $test);


        $test = new Formule();
        $test->setLabel('Fomule à 15€');
        $test->setPrice(15);
        $manager->persist($test);
        $this->addReference('formule2', $test);


        $manager->flush();
    }
}
