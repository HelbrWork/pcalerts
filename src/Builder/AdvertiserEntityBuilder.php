<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Advertiser;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

final readonly class AdvertiserEntityBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    ) {
    }

    public function build(array $data): void
    {
        foreach ($data as $item) {
            if (!isset($item['id'], $item['title'], $item['created_at'])) {
                $this->logger->warning('Skipping advertiser', ['item' => $item]);
                continue;
            }

            $advertiser = new Advertiser();

            if (!is_array($item['manager_obj'])) {
                $advertiser->setAffiseManagerId('');
            } else {
                $advertiser->setAffiseManagerId($item['manager_obj']['id']);
            }
            $advertiser
                ->setAffiseAdvertiserId($item['id'])
                ->setAffiseTitle($item['title'])
                ->setAffiseCreatedAt(new \DateTimeImmutable($item['created_at']));

            $this->entityManager->persist($advertiser);
        }
        $this->entityManager->flush();
    }
}