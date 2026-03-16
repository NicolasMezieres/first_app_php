<?php

namespace App\Controller;

use App\Dto\MailerDto;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{

    public function __construct(private MailerService $mailerService) {}

    #[Route("/email", name: "email", methods: "POST",)]
    public function sendEmail(#[MapRequestPayload] MailerDto $mailerDto)
    {
        $this->mailerService->sendEmail($mailerDto);
        return new JsonResponse(["message" => "Email send succes"], 201);
    }
}
