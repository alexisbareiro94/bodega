<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    protected $table = 'registers';

    protected $fillable = [
        'user_id',
        'name',
        'opening_balance',
        'closing_balance',
        'expected_balance',
        'status',
        'egresos',
        'ingresos',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function movements()
    {
        return $this->hasMany(RegisterMovement::class);
    }
}
