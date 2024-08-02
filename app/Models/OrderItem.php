<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'fruit_id', 'quantity', 'price'];
    use HasFactory;
    public function fruit()
{
    return $this->belongsTo(Fruit::class);
}
}
