<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "roles";
    public $primaryKey = 'id';
    protected $fillable = ['id', 'role_id','role_name', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id', 'role');
    }
}
