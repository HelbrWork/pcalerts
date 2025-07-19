<?php declare(strict_types=1);

namespace App\Entity;

use App\Repository\AdvertiserRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

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

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'advertisers')]
    #[JoinColumn(nullable: true)]
    private ?User $user;

    #[ORM\OneToMany(mappedBy: 'advertiser', targetEntity: Offer::class, cascade: ['persist'])]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): self
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setAdvertiser($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): self
    {
        if ($this->offers->contains($offer)) {
            $this->offers->removeElement($offer);
            $offer->setAdvertiser(null);
        }

        return $this;
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): Advertiser
    {
        $this->user = $user;

        return $this;
    }
}
