<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Offer;
use App\Repository\OfferRepository;
use Doctrine\ORM\EntityManagerInterface;

final readonly class OfferEntityBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private OfferRepository $offerRepository
    ) {
    }

    public function build(array $data): void
    {
        foreach ($data as $item) {
            /** @var Offer|null $existingOffer */
            $existingOffer = $this->offerRepository->findOneBy(['affiseOfferId' => $item['offer_id']]);
            if ($existingOffer !== null) {
                continue;
            }

            $offer = new Offer();
            $offer
                ->setAffiseAdvertiserId($item['advertiserId'] ?? null)
                ->setAffiseOfferId($item['offer_id'] ?? null)
                ->setTitle($item['title'] ?? null)
                ->setStatus($item['status'] ?? null)
                ->setGeo($item['geo'] ?? null);

            $this->entityManager->persist($offer);
        }

        $this->entityManager->flush();
    }
}
