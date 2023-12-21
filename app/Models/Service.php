<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'id',
        'service_name',
        'description',
        'price',
        'address',
        'ward',
        'district',
        'city',

    ];

    public function businesses()
    {
        return $this->belongsTo(Businesse::class, 'businesses_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'services_id');
    }
}
