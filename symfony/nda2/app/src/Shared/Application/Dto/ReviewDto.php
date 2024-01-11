<?php

namespace App\Shared\Application\Dto;

class ReviewDto
{
    public int    $score;
    public string $userName;
    public string $userEmail;
    public string $text;
    public string $city;

    public function getScore(): int
    {
        return $this->score;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
