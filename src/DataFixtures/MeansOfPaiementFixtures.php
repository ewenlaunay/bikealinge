<?php

namespace App\DataFixtures;

use App\Entity\MeanOfPaiement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MeansOfPaiementFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $test = new MeanOfPaiement();
        $test -> setLabel("Carte Bancaire");
        $manager->persist($test);

        $test2 = new MeanOfPaiement();
        $test2 -> setLabel("Paypal");
        $manager->persist($test2);

        $test3 = new MeanOfPaiement();
        $test3 -> setLabel("Virement");
        $manager->persist($test3);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [CityFixtures::class
        ];
    }
}
