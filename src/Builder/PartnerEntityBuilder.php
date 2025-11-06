<?php declare(strict_types=1);

namespace App\Builder;

use App\Entity\Partner;
use App\Repository\PartnerRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class PartnerEntityBuilder
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private PartnerRepository $partnerRepository
    ) {
    }
    public function build(array $partnerData): Partner
    {

        foreach ($partnerData as $partnerItem) {
            /** @var Partner|null $existingPartner */
            $existingPartner = $this->partnerRepository->findOneBy(['affisePartnerId' => $partnerItem['id']]);
            if ($existingPartner !== null) {
                continue;
            }
            $partner = new Partner();
            $partner->setAffisePartnerId($partnerData['id'] ?? '');
            $partner->setMsgType($partnerData['msgType'] ?? '');
            $partner->setMsgInfo($partnerData['msgInfo'] ?? '');
            $this->entityManager->persist($partner);
        }
        $this->entityManager->flush();

//        foreach ($partnerData['customFields'] ?? [] as $custom) {
//            if ($custom['id'] === 23) {
//                $partner->setMsgType($custom['value'] ?? null);
//            }
//            if ($custom['id'] === 24) {
//                $partner->setMsgInfo($custom['value'] ?? null);
//            }
//        }

        return $partner;
    }
}
