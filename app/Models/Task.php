<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','descryption','priority','user_id'];


    public function user() { // this function for relation between user and Tasks
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function favoriteByUser() {
        return $this->belongsToMany(User::class,'favorites_');
    }
}
