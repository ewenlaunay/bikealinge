<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $test = new User();
        $test->setFirstName('Launay');
        $test->setLastName('Ewen');
        $test->setBirthDate(new DateTime('1990/01/18'));
        $test->setAdress('impasse du lavoir');
        $test->setCity($this->getReference('rennescentre'));
        $test->setLogin('Ewen');
        $test->setEmail('ewen@gmail.com');
        $test->setPassword($this->encoder->encodePassword($test, '111111'));
        $manager->persist($test);
        $this->addReference('user1', $test);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function diff($datetime2, $absolute = false)
    {
        // TODO: Implement diff() method.
    }

    /**
     * @inheritDoc
     */
    public function format($format)
    {
        // TODO: Implement format() method.
    }

    /**
     * @inheritDoc
     */
    public function getOffset()
    {
        // TODO: Implement getOffset() method.
    }

    /**
     * @inheritDoc
     */
    public function getTimestamp()
    {
        // TODO: Implement getTimestamp() method.
    }

    /**
     * @inheritDoc
     */
    public function getTimezone()
    {
        // TODO: Implement getTimezone() method.
    }

    /**
     * @inheritDoc
     */
    public function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    /**
     * @inheritDoc
     */
    public function getDependencies()
    {
        return [
            CityFixtures::class
        ];
    }


}
