<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'first_name',
        'last_name',
        'profile_picture',
        'address',
        'ward',
        'district',
        'city',
        'country',
    ];

    public function users()
    {

        return $this->belongsTo(User::class, 'users_id');
    }
}
