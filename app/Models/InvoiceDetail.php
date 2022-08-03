<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'unit_id',
        'rental_date',
        'rental_time',
        'subtotal',
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
