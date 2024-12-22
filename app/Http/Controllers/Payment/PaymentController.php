<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\InitializePaymentRequest;
use App\Http\Requests\Payment\VerifyPaymentRequest;
use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Initialize a payment.
     */
    public function initialize(InitializePaymentRequest $request)
    {
        $validated = $request->validated();
        $response = $this->paymentService->initializePayment($validated);

        return response()->json([
            'message' => 'Payment initialized successfully.',
            'data' => $response
        ], 200);
    }

    /**
     * Verify a payment.
     */
    public function verify(VerifyPaymentRequest $request)
    {
        $validated = $request->validated();
        $response = $this->paymentService->verifyPayment($validated['transaction_id']);

        return response()->json([
            'message' => 'Payment verified successfully.',
            'data' => $response
        ], 200);
    }
}
