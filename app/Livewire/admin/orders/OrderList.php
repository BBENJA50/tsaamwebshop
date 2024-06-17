<?php

namespace App\Livewire\admin\orders;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $orders;
    public $expandedOrderId;

    public function mount()
    {
        $this->orders = Order::with('details')->orderBy('ordered_at', 'desc')->get();
        $this->expandedOrderId = null;
    }

    public function toggleOrderDetails($orderId)
    {
        if ($this->expandedOrderId === $orderId) {
            $this->expandedOrderId = null;
        } else {
            $this->expandedOrderId = $orderId;
        }
    }

    public function render()
    {
        return view('livewire.admin.orders.order-list');
    }
}
