<?php

namespace App\Dto;

use App\Entity\UserEntity;
use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\PasswordStrength;

#[Map(target: UserEntity::class)]
class UserDto
{
    #[Assert\NotBlank(message: "Name is required")]
    #[Assert\Length(min: 2, max: 50, minMessage: "Name need to have at least {{ limit }} characters.", maxMessage: "Name must be less than {{ limit }} characters long.")]
    #[Assert\Type("string")]
    #[Map(target: "name")]
    public string $name = "";

    #[Assert\NotBlank(message: "Email is required")]
    #[Assert\Email(message: "The email {{ value }} is not a valid email !")]
    #[Map(target: "email")]
    public string $email = "";

    #[Assert\NotBlank(message: "Username is required")]
    #[Assert\Length(min: 3, minMessage: "Username need to have at least {{ limit }} characteres.", max: 16, maxMessage: "Username must be less than {{ limit }} characters long.")]
    #[Assert\Type("string")]
    #[Map(target: "username")]
    public string $username = "";

    #[Assert\NotBlank(message: "Age is required")]
    #[Assert\Type("int", "The value {{ value }} is not a valid {{ type }}")]
    #[Assert\Range(min: 18, max: 130, notInRangeMessage: "Age must be between {{ min }} and {{ max }} years")]
    #[Map(target: "age")]
    public int $age = 0;

    #[Assert\Type(type: "string")]
    #[Assert\Length(max: 50, maxMessage: "FirstName must be less than {{ limit } characters long.")]
    #[Map(target: "firstName")]
    public string $firstName = "";

    #[Assert\Type(type: "string")]
    #[Assert\Length(max: 50, maxMessage: "FirstName must be less than {{ limit }} characters long.")]
    #[Map(target: "lastName")]
    public string $lastName = "";

    #[Assert\NotBlank(message: "Password is required")]
    #[Assert\Type(type: "string")]
    #[Assert\Length(min: 16, max: 255,)]
    #[Assert\PasswordStrength(minScore: PasswordStrength::STRENGTH_STRONG, message: "Your password is too predictable")]
    public string $password = "";
}
