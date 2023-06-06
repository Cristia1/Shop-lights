<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'price'];
    protected $primaryKey = 'id_order';
    public $timestamps = false;

    // Accessor for calculating the total
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }
}
