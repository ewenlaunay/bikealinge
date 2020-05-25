<?php

namespace App\DataFixtures;


use App\Entity\Order;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {


        $test = new Order();
        $test->setReference('1234');
        $test->setCreationDate(new DateTime('2020/05/22'));
        $test->setUser($this->getReference('user1'));
        $test->setMeanOfPaiement($this->getReference('mop-cb'));
        $test->setStatus($this->getReference('encours'));
        $test->setFormule($this->getReference('formule1'));
        $test->setPrice('1000');
        $manager->persist($test);
        $this->addReference('order1', $test);




        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            MeansOfPaiementFixtures::class,
            UserFixtures::class,
            StatusFixtures::class,
        ];
    }
}
