<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'parent_id',
        'parent_name',
        'child_id',
        'child_name',
        'total_price',
        'ordered_at',
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
