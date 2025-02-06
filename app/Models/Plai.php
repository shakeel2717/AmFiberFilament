<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plai extends Model
{
    //
    protected $fillable = [
        'name',
        'price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
