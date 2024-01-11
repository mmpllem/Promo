<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshTokenRepository;
use Gesdinet\JWTRefreshTokenBundle\Model\AbstractRefreshToken;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: RefreshTokenRepository::class)]
class RefreshToken extends AbstractRefreshToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string')]
    protected $refreshToken;

    #[ORM\Column(type: 'string')]
    protected $username;

    #[ORM\Column(type: 'datetime')]
    protected $valid;

    #[ORM\JoinColumn(nullable: false,referencedColumnName: "uuid")]
    #[ORM\ManyToOne(targetEntity: User::class)]
    private UserInterface $user;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeInterface $createAt;

    #[ORM\PrePersist]
    public function setCreatedAtValue(): void
    {
        $this->createAt = new \DateTimeImmutable();
    }

    public function getUser(): UserInterface
    {
        return $this->user;
    }

    public function setUser(UserInterface $user): RefreshToken
    {
        $this->user = $user;

        return $this;
    }

    public function getCreateAt(): \DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): RefreshToken
    {
        $this->createAt = $createAt;

        return $this;
    }

    public static function createForUserWithTtl(
        string $refreshToken,
        UserInterface $user,
        int $ttl
    ): RefreshTokenInterface {
        /**
         * @var $entity RefreshToken
         */
        $entity = parent::createForUserWithTtl($refreshToken, $user, $ttl);
        $entity->setUser($user);

        return $entity;
    }
}
