<?php

namespace App\Sight\Domain\Entity;

use App\Settlement\Domain\Entity\Settlement;
use App\Sight\Application\Collection\SightPartCollection;

class Sight
{
    protected int                  $id;
    protected string               $code;
    protected string               $name;
    protected string               $coordinates;
    protected SightType            $type;
    protected Settlement           $settlement;
    protected ?SightTicketInfo     $sightTicketInfo;
    protected ?string              $description;
    protected ?string              $additionalDescription;
    protected string               $check;
    protected ?array               $includedInCheck;
    protected ?array               $phone;
    protected ?array               $email;
    protected array                $address;
    protected ?array               $workingHours;
    protected ?string              $site;
    protected string               $image;
    protected ?SightPartCollection $sightParts;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCoordinates(): string
    {
        return $this->coordinates;
    }

    public function getType(): SightType
    {
        return $this->type;
    }

    public function getSettlement(): Settlement
    {
        return $this->settlement;
    }

    public function getSightTicketInfo(): ?SightTicketInfo
    {
        return $this->sightTicketInfo;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getAdditionalDescription(): ?string
    {
        return $this->additionalDescription;
    }

    public function getCheck(): string
    {
        return $this->check;
    }

    public function getIncludedInCheck(): ?string
    {
        return $this->includedInCheck;
    }

    public function getPhone(): ?array
    {
        return $this->phone;
    }

    public function getEmail(): ?array
    {
        return $this->email;
    }

    public function getAddress(): array
    {
        return $this->address;
    }

    public function getWorkingHours(): ?array
    {
        return $this->workingHours;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getSightParts(): ?SightPartCollection
    {
        return $this->sightParts;
    }
}
