<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model 
{
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->belongsToMany(User::class,'likes');
    }

    public function favorites() {
        return $this->belongsToMany(User::class,'favorites');
    }

    public function ingredients() {
        return $this->hasMany(Ingredient::class);
    }

    public function comments() {
        return $this->belongsToMany(User::class,'comments');
    }
}

?>