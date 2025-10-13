<?php declare(strict_types=1);

namespace App\Entity;
use App\Repository\StreamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: StreamRepository::class)]
class Stream
{
    use TimestampableEntity;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $source = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $sourceComment = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $streamComment = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $lastConvAt;

    #[OneToMany(mappedBy: 'stream', targetEntity: Offer::class)]
    private Collection $offers;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $revenue = null;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Stream
    {
        $this->id = $id;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): Stream
    {
        $this->source = $source;

        return $this;
    }

    public function getSourceComment(): ?string
    {
        return $this->sourceComment;
    }

    public function setSourceComment(?string $sourceComment): Stream
    {
        $this->sourceComment = $sourceComment;

        return $this;
    }

    public function getStreamComment(): ?string
    {
        return $this->streamComment;
    }

    public function setStreamComment(?string $streamComment): Stream
    {
        $this->streamComment = $streamComment;

        return $this;
    }

    public function getLastConvAt(): ?\DateTime
    {
        return $this->lastConvAt;
    }

    public function setLastConvAt(?\DateTime $lastConvAt): Stream
    {
        $this->lastConvAt = $lastConvAt;

        return $this;
    }

    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function setOffers(Collection $offers): Stream
    {
        $this->offers = $offers;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(?int $revenue): Stream
    {
        $this->revenue = $revenue;

        return $this;
    }

}