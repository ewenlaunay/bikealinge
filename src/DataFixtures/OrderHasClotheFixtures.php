<?php

namespace App\DataFixtures;

use App\Entity\OrderHasClothe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderHasClotheFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $test = new OrderHasClothe();
        $test->setOrder($this->getReference('order1'));
        $test->setClothe($this->getReference('jean'));
        $test->setAdult(1);
        $test->setChild(0);
        $manager->persist($test);


        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            OrderFixtures::class,
            ClotheFixtures::class,
        ];
    }
}
