<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        $lineItems = [];
        $children = Auth::user()->children;

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // amount in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        return view('checkout', [
            'lineItems' => $lineItems,
            'cart' => $cart,
            'children' => $children,
            'cartTotal' => collect($cart)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0),
        ]);
    }

    public function processCheckout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $cart = session()->get('cart', []);
        $lineItems = [];

        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // amount in cents
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $checkoutSession = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success()
    {
        // Clear the cart after successful payment
        session()->forget('cart');

        return view('success');
    }

    public function cancel()
    {
        return view('cancel');
    }
}
