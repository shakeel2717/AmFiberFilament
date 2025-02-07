<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    //
    protected $fillable = [
        'quotation_id',
        'product_id',
        'width',
        'height',
        'quantity',
        'price',
        'total',
    ];
}
