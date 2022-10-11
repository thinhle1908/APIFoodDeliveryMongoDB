<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "orders";
    protected $primarykey = 'id';
    protected $fillable = ['id','customer_stripe_id', 'user_id','name','address','phone','email','note','total','order_status','created_at','updated_at'];
    public $timestamps = true;
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
