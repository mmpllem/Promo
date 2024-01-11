<?php

namespace App\Sight\Application\Dto;

class SightBookingRequestDto
{
    public string $fullName;
    public string $phone;
    public string $email;
    public int    $countChildPersons;
    public int    $countAdultPersons;

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCountChildPersons(): int
    {
        return $this->countChildPersons;
    }

    public function getCountAdultPersons(): int
    {
        return $this->countAdultPersons;
    }
}
