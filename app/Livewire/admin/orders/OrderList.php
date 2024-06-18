<?php

namespace App\Livewire\admin\orders;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $orders; // Lijst van bestellingen
    public $expandedOrderId; // ID van de uitgevouwen bestelling

    /**
     * Initialiseer de component en laad de bestellingen.
     */
    public function mount()
    {
        $this->orders = Order::with('details')->orderBy('ordered_at', 'desc')->get();
        $this->expandedOrderId = null; // Standaard geen uitgevouwen bestelling
    }

    /**
     * Schakel de weergave van bestellingsdetails.
     *
     * @param int $orderId
     */
    public function toggleOrderDetails($orderId)
    {
        if ($this->expandedOrderId === $orderId) {
            $this->expandedOrderId = null; // Verberg de details als dezelfde bestelling wordt aangeklikt
        } else {
            $this->expandedOrderId = $orderId; // Toon de details van de aangeklikte bestelling
        }
    }

    /**
     * Render de Livewire component view.
     */
    public function render()
    {
        return view('livewire.admin.orders.order-list');
    }
}
