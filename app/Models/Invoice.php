<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['customer_id', 'invoice_number', 'invoice_date', 'total', 'status'];

    protected static function boot()
    {
        parent::boot();

        // Automatically generate an invoice number before saving
        static::creating(function ($invoice) {
            if (empty($invoice->invoice_number)) {
                $invoice->invoice_number = 'INV-' . now()->format('YmdHis');
            }
        });

        // After an invoice is created, update the total
        static::created(function ($invoice) {
            $invoice->updateTotal();
        });

        // Automatically update the invoice total when items are changed
        static::updated(function ($invoice) {
            $invoice->updateTotal();
        });

        static::deleting(function ($invoice) {
            $invoice->items()->delete(); // Delete related items when invoice is deleted
        });
    }

    public function updateTotal()
    {
        if ($this->exists) { // Ensure the invoice exists before updating
            $this->total = $this->items()->sum('total');
            $this->saveQuietly(); // Prevent infinite loop of saving
        }
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
