<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = ['party_id', 'amount', 'payment_method', 'reference'];

    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
