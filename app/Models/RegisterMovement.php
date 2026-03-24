<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterMovement extends Model
{
    protected $table = 'register_movements';

    protected $fillable = [
        'register_id',
        'user_id',
        'type',
        'payment_method',
        'mixto_one',
        'mixto_two',
        'amount',
        'description',
    ];

    public function register()
    {
        return $this->belongsTo(Register::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
