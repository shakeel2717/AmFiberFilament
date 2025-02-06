<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = ['invoice_id', 'description', 'quantity', 'unit_price', 'total'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Calculate total before saving
        static::creating(function ($item) {
            $item->total = $item->quantity * $item->unit_price;
        });

        static::saving(function ($item) {
            $item->total = $item->quantity * $item->unit_price;
        });

        // Update invoice total after saving an item
        static::saved(function ($item) {
            $item->invoice->updateTotal();
        });

        // Update invoice total after deleting an item
        static::deleted(function ($item) {
            $item->invoice->updateTotal();
        });
    }
}
