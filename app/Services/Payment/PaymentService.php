<?php

namespace App\Services\Payment;

use App\Factories\PaymentGatewayFactory;

class PaymentService
{
    public function processPayment(string $gateway, array $data): string
    {
        $paymentGateway = PaymentGatewayFactory::create($gateway);
        return $paymentGateway->initiatePayment($data);
    }

    public function verifyPayment(string $gateway, string $transactionId): bool
    {
        $paymentGateway = PaymentGatewayFactory::create($gateway);
        return $paymentGateway->verifyPayment($transactionId);
    }

    public function handleWebhook(string $gateway, array $payload): void
    {
        $paymentGateway = PaymentGatewayFactory::create($gateway);
        $paymentGateway->handleWebhook($payload);
    }
}
