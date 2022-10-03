<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "order_details";
    protected $primaryKey = ['order_id', 'product_id'];
    public $incrementing = false;
    protected $fillable = ['order_id', 'product_id', 'qty', 'price', 'created_at', 'updated_at'];
    public $timestamps = true;
    use HasFactory;
}
