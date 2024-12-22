<?php

namespace Tests\Unit\Payment;

use App\Services\Payment\Gateways\Stripe;
use Tests\TestCase;

class StripeGatewayTest extends TestCase
{
    private Stripe $stripeGateway;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialize the StripeGateway instance
        $this->stripeGateway = new Stripe();
    }

    public function test_initiate_payment_returns_transaction_id()
    {
        // Arrange: Define sample payment data
        $paymentData = [
            'amount' => 100,
            'currency' => 'USD',
            'description' => 'Test Payment',
        ];

        // Act: Call initiatePayment
        $transactionId = $this->stripeGateway->initiatePayment($paymentData);

        // Assert: Ensure a valid transaction ID is returned
        $this->assertIsString($transactionId, 'Expected a transaction ID as a string');
        $this->assertNotEmpty($transactionId, 'Transaction ID should not be empty');
    }

    public function test_verify_payment_returns_true_on_success()
    {
        // Arrange: Define a valid transaction ID
        $transactionId = 'STRIPE_TEST_TRANSACTION_ID';

        // Act: Call verifyPayment
        $verificationResult = $this->stripeGateway->verifyPayment($transactionId);

        // Assert: Check the response
        $this->assertTrue($verificationResult, 'Expected payment verification to return true for valid transaction');
    }

    public function test_handle_webhook_processes_payload()
    {
        // Arrange: Define a sample webhook payload
        $webhookPayload = [
            'type' => 'payment_intent.succeeded',
            'data' => [
                'object' => [
                    'id' => 'pi_123456789',
                    'amount_received' => 10000,
                    'currency' => 'usd',
                ],
            ],
        ];

        // Act: Call handleWebhook (assuming it has no return value)
        $this->stripeGateway->handleWebhook($webhookPayload);

        // Assert: No exceptions are thrown (optional logging or database checks can be mocked here)
        $this->assertTrue(true, 'Webhook handler executed without errors');
    }
}
