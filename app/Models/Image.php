<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = [
        'url',
        'image_type',
        'services_id',
    ];
    public function services()
    {
        return $this->belongsTo(Service::class, 'services_id');
    }
}
