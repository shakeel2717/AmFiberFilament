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
    public function party() // Ye customer ka relation return karega
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function quotation_items()
{
    return $this->hasMany(QuotationItem::class, 'quotation_id');
}


}
