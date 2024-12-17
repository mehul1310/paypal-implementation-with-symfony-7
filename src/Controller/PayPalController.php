<?php

namespace App\Controller;

use App\Service\PayPalService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PayPalController extends AbstractController
{
    public function __construct(private PayPalService $payPalService)
    {
    }

    #[Route('/paypal/checkout', name: 'paypal_checkout', methods: ['GET'])]
    public function checkout(ParameterBagInterface $parameterBag): Response
    {
        return $this->render('paypal_checkout.html.twig', [
            'client_id' => $parameterBag->get('PAYPAL_CLIENT_ID'),
        ]);
    }

    #[Route('/paypal/create-order', name: 'paypal_create_order', methods: ['POST'])]
    public function createOrder(): JsonResponse
    {
        try {
            $order = $this->payPalService->createOrder(20);
            return new JsonResponse(['orderID' => $order['id']]);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/paypal/capture-order/{orderId}', name: 'paypal_capture_order', methods: ['POST'])]
    public function captureOrder(string $orderId): JsonResponse
    {
        try {
            $capture = $this->payPalService->captureOrder($orderId);
            return new JsonResponse(['status' => 'success', 'details' => $capture]);
        } catch (\RuntimeException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }
}