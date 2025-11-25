<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // protected $fillable = ['user_id','phone','address','date_of_birth'];
    protected $guarded =['id'];
    public function user() { // this function for relation between user and profile
        return $this->belongsTo(User::class);
    }
}
