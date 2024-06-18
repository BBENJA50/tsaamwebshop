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
        // Haal de inhoud van de winkelwagen op uit de sessie
        $cart = session()->get('cart', []);
        $lineItems = [];
        $children = Auth::user()->children;

        // Bereid de line items voor de Stripe checkout sessie
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // bedrag in centen
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Render de checkout view met de nodige data
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
        // Stel de Stripe API sleutel in
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Haal de inhoud van de winkelwagen op uit de sessie
        $cart = session()->get('cart', []);

        // Controleer of de winkelwagen leeg is
        if (empty($cart)) {
            return redirect()->route('cancel');
        }

        $lineItems = [];

        // Bereid de line items voor de Stripe checkout sessie
        foreach ($cart as $item) {
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $item['name'],
                    ],
                    'unit_amount' => $item['price'] * 100, // bedrag in centen
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Maak de Stripe checkout sessie aan
        $checkoutSession = CheckoutSession::create([
            'payment_method_types' => ['card', 'p24', 'bancontact'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        // Redirect naar de Stripe checkout sessie
        return redirect($checkoutSession->url);
    }

    public function success()
    {
        // Haal de gebruiker en kind informatie op
        $user = Auth::user();

        // Haal de winkelwagen details op uit de sessie
        $cart = session()->get('cart', []);

        // Groepeer de winkelwagen items per child_id
        $cartByChild = [];
        foreach ($cart as $item) {
            $cartByChild[$item['child_id']][] = $item;
        }

        // Maak aparte bestellingen voor elk kind
        foreach ($cartByChild as $childId => $items) {
            $child = $user->children->find($childId);
            $totalPrice = collect($items)->reduce(function ($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0);

            // Maak de bestelling aan
            $order = Order::create([
                'order_number' => uniqid('ORDER-'),
                'parent_id' => $user->id,
                'parent_name' => $user->first_name . ' ' . $user->last_name,
                'child_id' => $child->id,
                'child_name' => $child->first_name . ' ' . $child->last_name,
                'total_price' => $totalPrice,
                'ordered_at' => now(),
            ]);

            // Maak de order details aan
            foreach ($items as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'product_name' => $item['name'],
                    'product_option' => $item['attribute_option'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);
            }
        }

        // Wis de winkelwagen na succesvolle betaling
        session()->forget('cart');
        session()->forget('myCount');

        return view('success');
    }

    public function cancel()
    {
        return view('cancel');
    }
}
