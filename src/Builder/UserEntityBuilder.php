<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserEntityBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher,
        private UserRepository $userRepository
    ) {
    }

    public function build(array $data): void
    {
        foreach ($data as $item) {
            /** @var User|null $existingUser */
            $existingUser = $this->userRepository->findOneBy(['email' => $item['email']]);
            if ($existingUser !== null) {
                continue;
            }
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