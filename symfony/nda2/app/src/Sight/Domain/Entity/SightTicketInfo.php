<?php

namespace App\Sight\Domain\Entity;

use DateTime;

class SightTicketInfo
{
    protected int      $id;
    protected int      $price;
    protected DateTime $date;
    protected int      $duration;

    public function getId(): int
    {
        return $this->id;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getDate(): DateTime
    {
        return $this->date;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}
