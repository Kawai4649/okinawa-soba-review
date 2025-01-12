<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory; 

    protected $table = 'stores';

    protected $fillable = [
        'name',
        'kana',
        'picture',
        'postalcode',
        'address',
        'openinghours',
        'closeddays',
        'latitude',
        'longitude',
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}


