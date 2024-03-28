<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function prefecture()
    {
        return $this->belongsTo(prefecture::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ikitais()
    {
        return $this->hasMany(Ikitai::class);
    }

    public function empathies()
    {
        return $this->hasMany(Empathy::class);
    }

    public function is_ikitaied_by_auth_user()
    {
        $user_id = Auth::id();
        
        $ikitais = array();
        foreach($this->ikitais as $ikitai) {
            array_push($ikitais, $ikitai->user_id);
        }

        if(in_array($user_id, $ikitais)) {
            return true;
        } else {
            return false;
        }
        
    }

    public function is_empathized_by_auth_user()
    {
        $user_id = Auth::id();
        
        $empathies = array();
        foreach($this->empathies as $empathy) {
            array_push($empathies, $empathy->user_id);
        }

        if(in_array($user_id, $empathies)) {
            return true;
        } else {
            return false;
        }
        
    }

    
}
