<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $primaryKey = 'blog_id';
    protected $table = "blogs";
    protected $fillable = ['blog_id','user_id','blog_date', 'blog_content','blog_status','blog_type','blog_like_count','blog_comment_count','blog_has_article','article_title','article_content','created_at','updated_at'];
    public $timestamps = true;
    use HasFactory;
    
}
