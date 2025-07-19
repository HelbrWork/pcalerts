<?php declare(strict_types=1);

namespace App\Service;

use App\Entity\Advertiser;
use App\Repository\AdvertiserRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class UserAdvertiserConnector
{
    public function __construct(
        private UserRepository $userRepository,
        private AdvertiserRepository $advertiserRepository,
        private EntityManagerInterface $em
    ) {
    }

    public function connect(): void
    {
        $allAdvertisers = $this->advertiserRepository->findAll();
        /** @var Advertiser $advertiser */
        foreach ($allAdvertisers as $advertiser) {
            $user = $this->userRepository->findOneBy(['affiseUserID' => $advertiser->getAffiseManagerId()]);
            $advertiser->setUser($user);
        }

        $this->em->flush();
    }
}
