<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['invoice_id', 'customer_id', 'quotation_id', 'type', 'amount', 'transaction_date'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
