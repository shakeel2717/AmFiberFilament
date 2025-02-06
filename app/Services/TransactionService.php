<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{
    public function recordTransaction($data)
    {
        return Transaction::create($data);
    }
}
