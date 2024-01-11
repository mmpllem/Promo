<?php

namespace App\Domain\Repository;

use App\Domain\Dto\NewUserDto;
use App\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function existByEmail(string $email): bool;

    public function getUser(string $userId): User;

    public function createUser(NewUserDto $newUser): User;
}
