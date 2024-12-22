<?php

namespace App\Contracts;

interface PaymentGatewayInterface
{
    public function initiatePayment(array $data): string;
    public function verifyPayment(string $transactionId): bool;
    public function handleWebhook(array $payload): void;
}
