<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\City;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'tel',
        'age',
        'email',
        'city',
        'income',
        'services',
        'assign_to',
        'loan_status',
        'reason_to_reject',
        'loan_amount',
        'expected_amount',
        'documents',
        'created_at',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'services');
    }

    public function cities()
    {
        return $this->belongsTo(City::class, 'city');
    }
}
