<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'user_id'];
    protected $primaryKey = 'id';
    protected $dates = ['created_at', 'updated_at'];
}
