<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'partner')]
class Partner
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $affiseId;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $msgType = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $msgInfo = null;

    public function getId(): int
    {
        return $this->id;
    }

    public function getAffiseId(): string
    {
        return $this->affiseId;
    }

    public function setAffiseId(string $affiseId): void
    {
        $this->affiseId = $affiseId;
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
