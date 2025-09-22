<?php declare(strict_types=1);

namespace App\Entity;
use App\Repository\StreamRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
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
    private ?string $lastConvAt;

    #[ORM\Column(type: Types::INTEGER)]
    private ?int $revenue = null;

}