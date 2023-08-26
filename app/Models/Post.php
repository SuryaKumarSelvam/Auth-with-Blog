<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['post_tittle','post_description','user_id'];

    public function comment(){
        return $this->hasMany(Comment::class);
    }
}
