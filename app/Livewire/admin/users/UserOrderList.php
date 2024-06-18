<?php

namespace App\Livewire\admin\users;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrderList extends Component
{
    use WithPagination;

    public $userId;
    public $expandedOrder = [];

    public function mount()
    {
        $this->userId = auth()->user()->id;
    }

    public function toggleDetails($orderId)
    {
        if (isset($this->expandedOrder[$orderId])) {
            unset($this->expandedOrder[$orderId]);
        } else {
            $this->expandedOrder[$orderId] = true;
        }
    }

    public function render()
    {
        $orders = Order::where('parent_id', $this->userId)
            ->orderBy('ordered_at', 'desc')
            ->with('details')
            ->paginate(10);

        return view('livewire.admin.users.user-order-list', [
            'orders' => $orders,
        ]);
    }
}
