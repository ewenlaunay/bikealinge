<?php

namespace App\DataFixtures;

use App\Entity\Clothe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClotheFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new Clothe();
        $test->setTitle('jean');
        $test->setComposition('denim');
        $test->setWeightAdult('300.00');
        $test->setWeightChild('200.00');
        $manager->persist($test);
        $this->addReference('jean', $test);


        $test = new Clothe();
        $test->setTitle('pantalon');
        $test->setComposition('coton');
        $test->setWeightAdult('250.00');
        $test->setWeightChild('150.00');
        $manager->persist($test);
        $this->addReference('pantalon', $test);


        $test = new Clothe();
        $test->setTitle('chemise');
        $test->setComposition('coton');
        $test->setWeightAdult('100.00');
        $test->setWeightChild('80.00');
        $manager->persist($test);
        $this->addReference('chemise', $test);


        $test = new Clothe();
        $test->setTitle('tee-shirt');
        $test->setComposition('coton');
        $test->setWeightAdult('100.00');
        $test->setWeightChild('80.00');
        $manager->persist($test);

        $test = new Clothe();
        $test->setTitle('pull');
        $test->setComposition('coton');
        $test->setWeightAdult('150.00');
        $test->setWeightChild('100.00');
        $manager->persist($test);

        $test = new Clothe();
        $test->setTitle('paire de chaussettes');
        $test->setComposition('coton');
        $test->setWeightAdult('30.00');
        $test->setWeightChild('20.00');
        $manager->persist($test);

        $test = new Clothe();
        $test->setTitle('caleçon');
        $test->setComposition('coton');
        $test->setWeightAdult('50.00');
        $test->setWeightChild('30.00');
        $manager->persist($test);

        $test = new Clothe();
        $test->setTitle('culotte');
        $test->setComposition('coton');
        $test->setWeightAdult('40.00');
        $test->setWeightChild('20.00');
        $manager->persist($test);

        $manager->flush();
    }
}
