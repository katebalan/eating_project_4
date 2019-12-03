<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->getFirstName('Kate');
        $user->getSecondName('Balan');
        $user->getAge(22);
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
