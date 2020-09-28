<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function statistic(){
        return $this->hasMany(Statistic::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
