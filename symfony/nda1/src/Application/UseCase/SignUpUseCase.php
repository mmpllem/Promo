<?php

namespace App\Application\UseCase;

use App\Domain\Dto\NewUserDto;
use App\Domain\Service\SignUpService;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;

readonly class SignUpUseCase
{
    public function __construct(
        private SignUpService $service,
        private AuthenticationSuccessHandler $successHandler
    ) {
    }

    public function execute(NewUserDto $userDto): JWTAuthenticationSuccessResponse
    {
        return $this->successHandler->handleAuthenticationSuccess($this->service->signUp($userDto));
    }
}
