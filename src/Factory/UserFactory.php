<?php declare(strict_types=1);

namespace App\Factory;

use App\Entity\User;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<User>
 */
final class UserFactory extends PersistentObjectFactory
{
    protected function defaults(): array|callable
    {
        return [
            'email' => self::faker()->email(),
            'tgName' => '@'.self::faker()->firstName().self::faker()->numberBetween(0,500),
            'active' => self::faker()->boolean(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
            'password' => 'qwerty123',
            'roles' => ['ROLE_USER'],
        ];
    }

    public static function getMainUser(): User
    {
        return self::createOne(
            [
                'email' => 'admin@admin.com',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'roles' => ['ROLE_ADMIN','ROLE_USER'],
                'active' => true,
                'tgName' => '@admin'
            ]
        );
    }

    public static function class(): string
    {
        return User::class;
    }
}