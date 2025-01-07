<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'number', 'address', 'city', 'state', 'services', 'document'];

    public function stateName()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function cityName()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
