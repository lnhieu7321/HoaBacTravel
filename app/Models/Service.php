<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'service_name',
        'description',
        'prices',
        'address',
        'ward',
        'district',
        'city',
        'country',

    ];

    public function businesses()
    {
        return $this->belongsTo(Businesse::class, 'businesses_id');
    }
}
