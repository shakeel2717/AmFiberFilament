<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function plai()
    {
        return $this->hasOne(Plai::class);
    }
}
