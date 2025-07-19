<?php

namespace App\Entity;

use App\Repository\PartnerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartnerRepository::class)]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $affisePartnerId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $msgType = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $msgInfo = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAffisePartnerId(): string
    {
        return $this->affisePartnerId;
    }

    public function setAffisePartnerId(string $affisePartnerId): void
    {
        $this->affisePartnerId = $affisePartnerId;
    }

    public function getMsgType(): ?string
    {
        return $this->msgType;
    }

    public function setMsgType(?string $msgType): void
    {
        $this->msgType = $msgType;
    }

    public function getMsgInfo(): ?string
    {
        return $this->msgInfo;
    }
    
    public function setMsgInfo(?string $msgInfo): void
    {
        $this->msgInfo = $msgInfo;
    }
}
