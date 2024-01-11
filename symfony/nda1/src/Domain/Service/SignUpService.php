<?php

namespace App\Domain\Service;

use App\Domain\Dto\NewUserDto;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Exception\UserAlreadyExistException;

class SignUpService
{
    private const DEFAULT_USER_ROLES = ['ROLE_USER'];

    public function __construct(
        private readonly UserRepositoryInterface $repository,
    ) {
    }

    public function signUp(NewUserDto $newUser): User
    {
        if ($this->repository->existByEmail($newUser->email)) {
            throw new UserAlreadyExistException();
        }
        $newUser->roles = self::DEFAULT_USER_ROLES;
        return $this->repository->createUser($newUser);
    }
}
