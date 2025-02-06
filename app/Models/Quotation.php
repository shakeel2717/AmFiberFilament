<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = ['customer_id', 'quotation_number', 'quotation_date', 'total'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
