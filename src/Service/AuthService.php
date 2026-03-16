<?php

namespace App\Service;

use App\Dto\UserDto;
use App\Entity\UserEntity;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AuthService
{
    private EntityManagerInterface $entityManager;
    private UserRepository $userRepository;
    private UserPasswordHasherInterface  $hasher;
    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository, UserPasswordHasherInterface  $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
        $this->hasher = $passwordHasher;
    }


    public function signup(UserDto $userDto)
    {
        $existingEmail = $this->userRepository->findOneBy(["email" => $userDto->email]);
        if ($existingEmail) {
            throw new HttpException(401, "Email already used");
        }
        $existingUsername = $this->userRepository->findOneBy(["username" => $userDto->username]);
        if ($existingUsername) {
            throw new HttpException(401, "Username already used");
        }
        $user = new UserEntity();
        $hashedPassword = $this->hasher->hashPassword($user, $userDto->password);
        $user->setEmail($userDto->email);
        $user->setName($userDto->name);
        $user->setUsername($userDto->username);
        $user->setAge($userDto->age);
        $user->setPassword($hashedPassword);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return new JsonResponse(["message" => "Inscription validé",], 201);
    }
}
