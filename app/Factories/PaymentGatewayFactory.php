<?php

namespace App\Factories;

use App\Contracts\PaymentGatewayInterface;
use App\Services\Payment\Gateways\PayPal;
use App\Services\Payment\Gateways\Stripe;

class PaymentGatewayFactory
{
    public static function create(string $gateway): PaymentGatewayInterface
    {
        return match ($gateway) {
            'stripe' => new Stripe(),
            'paypal' => new PayPal(),
            default => throw new \InvalidArgumentException('Unsupported gateway'),
        };
    }
}
