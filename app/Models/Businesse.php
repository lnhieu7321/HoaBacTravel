<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Businesse extends Model
{
    use HasFactory;
    // view page all booking
    protected $table = 'businesses';
    protected $fillable = [
        'business_name',
        'logo',
        'address',
        'ward',
        'district',
        'city',
        'country',
        'fanpage_url',
        'website_url',
    ];

    public function users()
    {

        return $this->belongsTo(User::class, 'users_id');
    }
    
}
