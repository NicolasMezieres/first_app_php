<?php

namespace App\Controller;

use App\Dto\UserDto;
use App\Service\AuthService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{

    public function __construct(private AuthService $authService) {}

    #[Route("/auth/signup", name: "auth_signup", methods: "POST",)]
    public function signup(#[MapRequestPayload] UserDto $userDto)
    {
        return $this->authService->signup($userDto);
    }
}
