<?php

namespace App\DataFixtures;

use App\Entity\Users;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsersFixtures extends Fixture
{
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
       $test = new Users();
       $test ->setFirstName("Ewen");
       $test ->setLastName("Launay");
       $test ->setEmail("ewen.launay889@gmail.com");
       $test ->setPassword("0000");
       $test ->setLogin("Ewen");
       $test ->setBirthDate(new DateTime('now'));
       $test ->setAdress("impasse du lavoir 35000 Rennes");
       $manager->persist($test);

        $test2 = new Users();
        $test2 ->setFirstName("Antoine");
        $test2 ->setLastName("Raoul");
        $test2 ->setEmail("antoineraoul@gmail.com");
        $test2 ->setPassword($this->encoder=1111);
        $test2 ->setLogin("Antoine");
        $test2 ->setBirthDate(new DateTime('now'));
        $test2 ->setAdress("rue du lavoir 35000 Rennes");
        $manager->persist($test2);

        $test3 = new Users();
        $test3 ->setFirstName("An");
        $test3 ->setLastName("Ra");
        $test3 ->setEmail("antaoul@gmail.com");
        $test3 ->setPassword($this->encoder=2222);
        $test3 ->setLogin("Ant");
        $test3 ->setBirthDate(new DateTime('now'));
        $test3 ->setAdress("rue du lr 35000 Rennes");
        $manager->persist($test3);


        $manager->flush();
    }
    public function getDependencies()
    {
        return [UsersFixtures::class
        ];
    }
}
