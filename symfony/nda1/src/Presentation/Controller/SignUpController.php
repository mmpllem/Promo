<?php

namespace App\Presentation\Controller;

use App\Application\UseCase\SignUpUseCase;
use App\Domain\Dto\NewUserDto;
use App\Domain\Model\SignUpRequestModel;
use App\Infrastructure\Attribute\RequestBody;
use App\Infrastructure\Hydrator\TypedReflectionHydrator;
use App\Infrastructure\Model\ErrorResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController extends AbstractController
{
    public function __construct(
        private readonly SignUpUseCase $useCase,
    ) {
    }

    #[Route(path: '/api/v1/user/auth/signUp', methods: ['POST'])]
    #[OA\RequestBody(
        description: 'User form',
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(ref: new Model(type: SignUpRequestModel::class))
        )
    )]
    #[OA\Response(
        response: 200,
        description: 'Sign up success',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'token'),
                new OA\Property(property: 'refresh_token'),
            ],
            type: 'object'
        )
    )]
    #[OA\Response(
        response: 409,
        description: 'User already exist',
        content: new Model(type: ErrorResponse::class)
    )]
    #[OA\Response(
        response: 400,
        description: 'Validation failed',
        content: new Model(type: ErrorResponse::class)
    )]
    #[OA\Tag(name: 'User')]
    public function signUp(#[RequestBody] SignUpRequestModel $signUpRequestModel): JWTAuthenticationSuccessResponse
    {
        return $this->useCase->execute(
            (new TypedReflectionHydrator())->hydrate($signUpRequestModel, NewUserDto::class)
        );
    }
}
