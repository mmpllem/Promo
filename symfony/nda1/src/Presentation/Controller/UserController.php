<?php

namespace App\Presentation\Controller;

use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class UserController extends AbstractController
{
    #[Route(path: '/api/v1/user/me', methods: ['GET'])]
    #[OA\HeaderParameter(
        name: 'Authorization',
        description: 'Токен',
        required: true,
        example: 'jwt-token'
    )]
    #[OA\Response(
        response: 200,
        description: 'User',
        content: new Model(type: UserInterface::class)
    )]
    #[OA\Response(
        response: 401,
        description: 'NotFound',
        content: new OA\JsonContent(
            properties: [
                new OA\Property(property: 'code', example: 401),
                new OA\Property(property: 'message', example: 'JWT Token not found'),
            ],
            type: 'object'
        )
    )]
    #[OA\Tag(name: 'User')]
    public function getCurrentUser(#[CurrentUser] UserInterface $user): JsonResponse
    {
        return $this->json(['data'=>$user]);
    }
}
