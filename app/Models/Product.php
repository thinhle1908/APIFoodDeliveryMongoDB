<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Product extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "products";
    protected $primarykey = 'id';
    protected $fillable = ['id','product_name','price','image','qty','description','visible','created_at','updated_at'];
    public $timestamps = true;
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
