<?php declare(strict_types=1);

namespace App\Connector;

use App\Entity\Advertiser;
use App\Entity\User;
use App\Repository\AdvertiserRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class UserAdvertiserApiConnector
{
    public function __construct(
        private UserRepository $userRepository,
        private AdvertiserRepository $advertiserRepository,
        private EntityManagerInterface $entityManager
    ) {
    }

    public function connect(): void
    {
        $allAdvertisers = $this->advertiserRepository->findAll();
        /** @var Advertiser $advertiser */
        foreach ($allAdvertisers as $advertiser) {
            $managerId = $advertiser->getAffiseManagerId();
            /** @var User|null $user */
            $user = $this->userRepository->findOneBy(['affiseUserID' => $managerId]);
            $user?->addAdvertiser($advertiser);
        }
        $this->entityManager->flush();
    }
}