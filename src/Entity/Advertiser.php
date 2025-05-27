<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AdvertiserRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdvertiserRepository::class)]
class Advertiser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int|null $id = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $affiseAdvertiserId;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $affiseManagerId;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $affiseTitle;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private DateTimeImmutable $affiseCreatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Advertiser
    {
        $this->id = $id;
        return $this;
    }

    public function getAffiseAdvertiserId(): string
    {
        return $this->affiseAdvertiserId;
    }

    public function setAffiseAdvertiserId(string $affiseAdvertiserId): Advertiser
    {
        $this->affiseAdvertiserId = $affiseAdvertiserId;
        return $this;
    }

    public function getAffiseManagerId(): string
    {
        return $this->affiseManagerId;
    }

    public function setAffiseManagerId(string $affiseManagerId): Advertiser
    {
        $this->affiseManagerId = $affiseManagerId;
        return $this;
    }

    public function getAffiseTitle(): string
    {
        return $this->affiseTitle;
    }

    public function setAffiseTitle(string $affiseTitle): Advertiser
    {
        $this->affiseTitle = $affiseTitle;
        return $this;
    }

    public function getAffiseCreatedAt(): DateTimeImmutable
    {
        return $this->affiseCreatedAt;
    }

    public function setAffiseCreatedAt(DateTimeImmutable $affiseCreatedAt): Advertiser
    {
        $this->affiseCreatedAt = $affiseCreatedAt;
        return $this;
    }
}