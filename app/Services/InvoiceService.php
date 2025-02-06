<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceService
{
    public function generateInvoiceNumber()
    {
        return 'INV-' . strtoupper(uniqid());
    }

    public function calculateTotal($items)
    {
        return collect($items)->sum(fn($item) => $item['quantity'] * $item['rate']);
    }
}
