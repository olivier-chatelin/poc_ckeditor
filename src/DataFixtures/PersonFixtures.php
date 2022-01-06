<?php

namespace App\DataFixtures;

use App\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $person = new Person();
        $person->setName('Olivier');
        $person->setMail('olivier.chatelin@gmail.com');
        $manager->persist($person);

        $person = new Person();
        $person->setName('admin');
        $person->setMail('admin.admin@gmail.com');
        $manager->persist($person);

        $manager->flush();
    }
}
