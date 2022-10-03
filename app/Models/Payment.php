<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $fillable = ['payment_id', 'order_id','amount','paid_by','date','processed','created_at','updated_at'];
    public $timestamps = true;
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
