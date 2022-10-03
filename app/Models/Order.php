<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    protected $table = "orders";
    protected $fillable = ['order_id','customer_stripe_id', 'user_id','name','address','phone','email','note','total','order_status','created_at','updated_at'];
    public $timestamps = true;
    use HasFactory;
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
