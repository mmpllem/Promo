<?php

namespace App\Domain\Service;

use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

readonly class RoleService
{
    public function __construct(
        private UserRepositoryInterface $repository,
        private EntityManagerInterface  $entityManager,
    ) {
    }

    public function grantManager(string $userId): void
    {
        $this->grantRole($userId, 'ROLE_MANAGER');
    }

    public function grantUser(string $userId): void
    {
        $this->grantRole($userId, 'ROLE_USER');
    }

    private function grantRole(string $userId, string $role): void
    {
        $user = $this->repository->getUser($userId);
        $user->setRoles([$role]);
        $this->entityManager->flush();
    }
}
