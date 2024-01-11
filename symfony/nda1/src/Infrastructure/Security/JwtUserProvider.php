<?php

namespace App\Infrastructure\Security;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\PayloadAwareUserProviderInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method UserInterface loadUserByIdentifierAndPayload(string $identifier, array $payload)
 */
final readonly class JwtUserProvider implements PayloadAwareUserProviderInterface
{
    public function __construct(
        private UserRepositoryInterface $repository,
    ) {
    }

    public function refreshUser(UserInterface $user): ?UserInterface
    {
        return null;
    }

    public function supportsClass(string $class): bool
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return $this->getUser('email', $identifier);
    }

    public function loadUserByUsernameAndPayload(string $username, array $payload): UserInterface
    {
        return $this->getUser('uuid', $payload['uuid']);
    }

    private function getUser($key, $value): UserInterface
    {
        $user = $this->repository->findOneBy([$key => $value]);
        if (null === $user) {
            $exception = new UserNotFoundException('User with id'.json_encode($value).'not found.');
            $exception->setUserIdentifier(json_encode($value));
            throw $exception;
        }

        return $user;
    }
}
