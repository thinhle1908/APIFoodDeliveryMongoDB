<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Blog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = "blogs";
    protected $fillable = ['user_id','blog_date', 'blog_content','blog_status','blog_type','blog_like_count','blog_comment_count','blog_has_article','article_title','article_content','created_at','updated_at'];
    public $timestamps = true;
    use HasFactory;
    
}
