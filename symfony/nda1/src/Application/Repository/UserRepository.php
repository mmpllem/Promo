<?php

namespace App\Application\Repository;

use App\Domain\Dto\NewUserDto;
use App\Domain\Entity\User;
use App\Domain\Repository\UserRepositoryInterface;
use App\Infrastructure\Exception\UserNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        private readonly UserPasswordHasherInterface $hasher,
        private EntityManagerInterface $em
    ) {
        parent::__construct($registry, User::class);
    }

    public function existByEmail(string $email): bool
    {
        return null !== $this->findOneBy(['email' => $email]);
    }

    public function getUser(string $userId): User
    {
        $user = $this->find($userId);
        if (null === $user) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function createUser(NewUserDto $newUser): User
    {
        $user = (new User())
            ->setUuid(Uuid::v1())
            ->setRoles($newUser->roles)
            ->setEmail($newUser->email)
            ->setFirstName($newUser->firstName)
            ->setLastName($newUser->lastName);
        $user->setPassword($this->hasher->hashPassword($user, $newUser->password));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }
}
