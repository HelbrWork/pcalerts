<?php declare(strict_types=1);

namespace App\Entity;
use App\Enum\StreamSource;
use App\Repository\StreamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity(repositoryClass: StreamRepository::class)]
class Stream
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, nullable: true, enumType: StreamSource::class)]
    private ?StreamSource $source = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $start_at = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $sourceComment = null;

    #[ORM\Column(type: Types::STRING, length: 100, nullable: true)]
    private ?string $streamComment = null;

    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $lastConvAt;

    #[OneToMany(mappedBy: 'stream', targetEntity: Offer::class)]
    private Collection $offers;

    #[ORM\Column(type: Types::INTEGER,nullable: true)]
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

    public function getSource(): ?StreamSource
    {
        return $this->source;
    }

    public function setSource(?StreamSource $source): Stream
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

    public function getLastConvAt(): ?\DateTimeImmutable
    {
        return $this->lastConvAt;
    }

    public function setLastConvAt(?\DateTimeImmutable $lastConvAt): Stream
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

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->start_at;
    }

    public function setStartAt(?\DateTimeImmutable $start_at): Stream
    {
        $this->start_at = $start_at;

        return $this;
    }


}