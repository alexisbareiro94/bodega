<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distribuidor extends Model
{
    protected $table = 'distributors';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
