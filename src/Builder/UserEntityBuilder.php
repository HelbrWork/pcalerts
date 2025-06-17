<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Advertiser;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

final readonly class UserEntityBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private LoggerInterface $logger
    ) {
    }

    public function build(array $data): void
    {
        foreach ($data as $item) {
            $user = new User();
            $user
                ->setFirstName($item['first_name'] ?? null)
                ->setLastName($item['last_name'] ?? null)
                ->setEmail($item['email'] ?? null)
                ->setTgName($item['telegram'] ?? null)
                ->setAffiseUserID($item['id'] ?? null)
                ->setPassword($this->passwordHasher->hashPassword($user,'Welcome_PC!'));
                if ($item['telegram'] === ''){
                    $user->setTgName(null);
                }
            $this->entityManager->persist($user);
        }
        $this->entityManager->flush();
    }
}