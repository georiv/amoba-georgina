<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Profile extends Model
{
    protected $fillable = ["Ima_profile"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
