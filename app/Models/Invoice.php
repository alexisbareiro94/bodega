<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'sale_id',
        'stamp',
        'status',
        'establishment',
        'point_of_sale',
        'invoice_number',
        'full_number',
        'issue_date',
        'total',
        'comment',
    ];

    protected $casts = [
        'issue_date' => 'date',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
