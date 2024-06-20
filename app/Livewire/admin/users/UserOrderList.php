<?php

namespace App\Livewire\admin\users;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class UserOrderList extends Component
{
    use WithPagination; // Gebruik paginering in dit component

    public $userId; // ID van de gebruiker
    public $expandedOrder = []; // Bijhouden van uitgevouwen bestellingen

    // De mount methode wordt uitgevoerd wanneer het component wordt geladen
    public function mount()
    {
        $this->userId = auth()->user()->id; // Stel de userId in op de ID van de ingelogde gebruiker
    }

    // Methode om details van een bestelling te toggelen
    public function toggleDetails($orderId)
    {
        if (isset($this->expandedOrder[$orderId])) {
            unset($this->expandedOrder[$orderId]); // Vouw de details van de bestelling in
        } else {
            $this->expandedOrder[$orderId] = true; // Vouw de details van de bestelling uit
        }
    }

    // Methode om de component te renderen
    public function render()
    {
        // Haal de bestellingen van de gebruiker op, inclusief details, gesorteerd op besteldatum
        $orders = Order::where('parent_id', $this->userId)
            ->orderBy('ordered_at', 'desc')
            ->with('details')
            ->paginate(10);

        // Retourneer de weergave met de bestellingen
        return view('livewire.admin.users.user-order-list', [
            'orders' => $orders,
        ]);
    }
}
