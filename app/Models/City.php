<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';
    protected $fillable = ['id','state','city'];

    public function stateName()
    {
        return $this->belongsTo(State::class, 'state');
    }
}