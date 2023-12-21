<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'ratings';
    protected $fillable = [
        'id',
        'rate',
        'comment',

    ];

    public function custommers()
    {
        return $this->belongsTo(Customer::class, 'customers_id ');
    }
    public function services()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'bookings_id');
    }
}
