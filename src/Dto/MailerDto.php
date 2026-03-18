<?php

namespace App\Dto;

use Symfony\Component\ObjectMapper\Attribute\Map;
use Symfony\Component\Validator\Constraints as Assert;


class MailerDto
{
    #[Assert\NotBlank(message: "Email is required")]
    #[Assert\Email(message: "The email {{ value }} is not a valid email !")]
    #[Map(target: "email")]
    public string $email = "";

    #[Assert\NotBlank(message: "Subject is required")]
    #[Assert\Length(max: 50, maxMessage: "Subject must be less than {{ limit }} characters long.")]
    #[Map(target: "subject")]
    public string $subject = "";

    #[Assert\NotBlank(message: "Text is required")]
    #[Map(target: "text")]
    public string $text = "";
}
