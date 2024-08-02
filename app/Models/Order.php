<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'total', 'status'];
    use HasFactory;
    public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
