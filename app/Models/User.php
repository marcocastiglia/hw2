<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function recipes() {
        return $this->hasMany(Recipe::class);
    }

    public function likes() {
        return $this->belongsToMany(Recipe::class,'likes');
    }

    public function favorites() {
        return $this->belongsToMany(Recipe::class,'favorites');
    }

    public function comments() {
        return $this->belongsToMany(Recipe::class,'comments');
    }
}

?>
