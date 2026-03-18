<?php

namespace App\Controller;

use App\Dto\MailerDto;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Target;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactoryInterface;
use Symfony\Component\Routing\Attribute\Route;

class MailerController extends AbstractController
{

    public function __construct(private MailerService $mailerService) {}

    #[Route("/email", name: "email", methods: "POST",)]
    public function sendEmail(Request $request, #[Target("contact_form")] RateLimiterFactoryInterface $rateLimiter, #[MapRequestPayload] MailerDto $mailerDto)
    {
        $limiter = $rateLimiter->create($request->getClientIp());
        $isAccepted = $limiter->consume(1)->isAccepted();
        if ($isAccepted === false) {
            throw new TooManyRequestsHttpException(message: "Too many requests, try again later");
        }

        $this->mailerService->sendEmail($mailerDto);
        return new JsonResponse(["message" => "Email send succes"], 201);
    }
}
