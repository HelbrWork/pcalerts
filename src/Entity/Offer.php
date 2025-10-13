<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int|null $id = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $affiseAdvertiserId = null;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $affiseOfferId;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $status;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $privacy  = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $geo = null;

    #[ORM\ManyToOne(targetEntity: Advertiser::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Advertiser $advertiser = null;

    #[ORM\ManyToOne(targetEntity: Stream::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Stream $stream = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Offer
    {
        $this->id = $id;

        return $this;
    }

    public function getAffiseOfferId(): string
    {
        return $this->affiseOfferId;
    }

    public function setAffiseOfferId(string $affiseOfferId): Offer
    {
        $this->affiseOfferId = $affiseOfferId;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Offer
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Offer
    {
        $this->status = $status;

        return $this;
    }

    public function getAffiseAdvertiserId(): ?string
    {
        return $this->affiseAdvertiserId;
    }

    public function setAffiseAdvertiserId(?string $affiseAdvertiserId): Offer
    {
        $this->affiseAdvertiserId = $affiseAdvertiserId;

        return $this;
    }

    public function getPrivacy(): ?string
    {
        return $this->privacy;
    }

    public function setPrivacy(?string $privacy): Offer
    {
        $this->privacy = $privacy;

        return $this;
    }


    public function getGeo(): ?string
    {
        return $this->geo;
    }

    public function setGeo(?string $geo): Offer
    {
        $this->geo = $geo;

        return $this;
    }

    public function getStream(): ?Stream
    {
        return $this->stream;
    }

    public function setStream(?Stream $stream): Offer
    {
        $this->stream = $stream;

        return $this;
    }

    public function getAdvertiser(): ?Advertiser
    {
        return $this->advertiser;
    }

    public function setAdvertiser(?Advertiser $advertiser): Offer
    {
        $this->advertiser = $advertiser;

        return $this;
    }
}
