<?php

namespace App\Sight\Domain\Entity;

class SightReview
{
    protected int    $id;
    protected string $createAt;
    protected string $updateAt;
    protected int    $score;
    protected string $text;
    protected string $userName;
    protected string $userId;
    protected bool   $moderated;
    protected string $moderatorId;
    protected string $sightId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getCreateAt(): string
    {
        return $this->createAt;
    }

    public function getUpdateAt(): string
    {
        return $this->updateAt;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function isModerated(): bool
    {
        return $this->moderated;
    }

    public function getModeratorId(): string
    {
        return $this->moderatorId;
    }

    public function getSightId(): string
    {
        return $this->sightId;
    }
}
