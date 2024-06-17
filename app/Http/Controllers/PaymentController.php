<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;

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
            'payment_method_types' => ['card', 'p24', 'bancontact'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return redirect($checkoutSession->url);
    }

    public function success()
    {
        // Retrieve user and child information
        $user = Auth::user();

        // Retrieve cart details
        $cart = session()->get('cart', []);

        // Group cart items by child_id
        $cartByChild = [];
        foreach ($cart as $item) {
            $cartByChild[$item['child_id']][] = $item;
        }

        // Create separate orders for each child
        foreach ($cartByChild as $childId => $items) {
            $child = $user->children->find($childId);
            $totalPrice = collect($items)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // Create the order
            $order = Order::create([
                'order_number' => uniqid('ORDER-'),
                'parent_id' => $user->id,
                'parent_name' => $user->first_name . ' ' . $user->last_name,
                'child_id' => $child->id,
                'child_name' => $child->first_name . ' ' . $child->last_name,
                'total_price' => $totalPrice,
                'ordered_at' => now(),
            ]);

            // Create order details
            foreach ($items as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }
        }

        // Clear the cart after successful payment
        session()->forget('cart');
        session()->forget('myCount');

        return view('success');
    }

    public function cancel()
    {
        return view('cancel');
    }
}
