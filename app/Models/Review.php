<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'service', 'description'];

    public function ServiceName()
    {
        return $this->belongsTo(Service::class, 'service');
    }
}
