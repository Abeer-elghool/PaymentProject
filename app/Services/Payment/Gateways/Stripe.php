<?php

namespace App\Services\Payment\Gateways;

use App\Contracts\PaymentGatewayInterface;

class Stripe implements PaymentGatewayInterface
{
    public function initiatePayment(array $data): string
    {
        // Simulate returning a transaction ID
        return 'STRIPE_TXN_' . uniqid();
    }

    public function verifyPayment(string $transactionId): bool
    {
        // Simulate verifying the payment (always true for now)
        return true;
    }

    public function handleWebhook(array $payload): void
    {
        // Simulate webhook handling
        // For example, log the event or update the database
        logger()->info('Stripe webhook received', $payload);
    }
}
