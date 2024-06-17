<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('stripe.secret'));
    }

    public function getRecentCharges($limit = 10)
    {
        return Charge::all(['limit' => $limit]);
    }

    public function getCustomers($limit = 10)
    {
        return Customer::all(['limit' => $limit]);
    }
}
