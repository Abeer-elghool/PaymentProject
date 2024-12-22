<?php

namespace Tests\Unit\Payment;

use App\Services\Payment\Gateways\PayPal;
use Tests\TestCase;

class PayPalGatewayTest extends TestCase
{
    private PayPal $payPalGateway;

    protected function setUp(): void
    {
        parent::setUp();

        // Initialize the PayPalGateway instance
        $this->payPalGateway = new PayPal();
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
        $transactionId = $this->payPalGateway->initiatePayment($paymentData);

        // Assert: Ensure a valid transaction ID is returned
        $this->assertIsString($transactionId, 'Expected a transaction ID as a string');
        $this->assertNotEmpty($transactionId, 'Transaction ID should not be empty');
    }

    public function test_verify_payment_returns_true_on_success()
    {
        // Arrange: Define a valid transaction ID
        $transactionId = 'TEST_TRANSACTION_ID';

        // Act: Call verifyPayment
        $verificationResult = $this->payPalGateway->verifyPayment($transactionId);

        // Assert: Check the response
        $this->assertTrue($verificationResult, 'Expected payment verification to return true for valid transaction');
    }

    public function test_handle_webhook_processes_payload()
    {
        // Arrange: Define a sample webhook payload
        $webhookPayload = [
            'event_type' => 'PAYMENT.CAPTURE.COMPLETED',
            'resource' => [
                'id' => 'PAYMENT12345',
                'amount' => [
                    'value' => '100.00',
                    'currency_code' => 'USD',
                ],
            ],
        ];

        // Act: Call handleWebhook (assuming it has no return value)
        $this->payPalGateway->handleWebhook($webhookPayload);

        // Assert: No exceptions are thrown (optional logging or database checks can be mocked here)
        $this->assertTrue(true, 'Webhook handler executed without errors');
    }
}
