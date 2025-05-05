<?php declare(strict_types=1);

namespace App\Fixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        UserFactory::createMany(200);

        $manager->flush();
    }
}