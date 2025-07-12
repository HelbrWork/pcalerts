<?php

namespace App\Builder;

use App\Entity\Partner;

class PartnerEntityBuilder
{
    public function build(array $partnerData): Partner
    {
        $partner = new Partner();
        $partner->setAffiseId($partnerData['id'] ?? '');

        foreach ($partnerData['customFields'] ?? [] as $custom) {
            if ($custom['id'] === 23) {
                $partner->setMsgType($custom['value'] ?? null);
            }
            if ($custom['id'] === 24) {
                $partner->setMsgInfo($custom['value'] ?? null);
            }
        }

        return $partner;
    }
}
