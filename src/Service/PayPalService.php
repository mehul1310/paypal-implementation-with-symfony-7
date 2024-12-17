<?php

namespace App\Service;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class PayPalService
{
    private PayPalHttpClient $client;

    public function __construct(string $clientId, string $clientSecret, bool $isSandbox = true)
    {
        $environment = $isSandbox
            ? new SandboxEnvironment($clientId, $clientSecret)
            : new ProductionEnvironment($clientId, $clientSecret);

        $this->client = new PayPalHttpClient($environment);
    }

    public function createOrder(float $amount, string $currency = 'USD'): array
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'amount' => [
                        'currency_code' => $currency,
                        'value' => number_format($amount, 2),
                    ]
                ]
            ]
        ];

        try {
            $response = $this->client->execute($request);
            return (array) $response->result;
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to create PayPal order: ' . $e->getMessage());
        }
    }

    public function captureOrder(string $orderId): array
    {
        $request = new OrdersCaptureRequest($orderId);
        $request->prefer('return=representation');

        try {
            $response = $this->client->execute($request);
            return (array) $response->result;
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to capture PayPal order: ' . $e->getMessage());
        }
    }
}