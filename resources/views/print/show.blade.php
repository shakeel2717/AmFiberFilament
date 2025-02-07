@extends('layouts.app')
@section('content')
    <div>
        <div class="header">
            <div class="labelandtime">
                <h1>Invoice</h1>
                <h5>Date: {{ $invoice->created_at->format('d-m-Y') }}</h5>
            </div>
        </div>

        <div class="details">
            <table>
                <tr>
                    <th>Customer Detail:</th>
                    <td>
                        <b>{{ strtoupper($invoice->party->name) }}</b>
                        <br>
                        <b>Phone:</b> {{ $invoice->party->phone }}
                        <br>
                        <b>Address:</b>
                        {{ $invoice->party->address }}
                    </td>
                    <th>Invoice #:</th>
                    <td style="width: 100px">{{ $invoice->id }}</td>
                </tr>
            </table>
        </div>

        <div class="highlighted-card">
            <div class="card">
                <div class="card-content">
                    <h3 class="">Customer Balance:
                        Rs: {{ number_format($invoice->party->balance(), 2) }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="products">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>

                        <th>Total SQFT</th>
                        <th>Quantity</th>
                        <th>Unit Price (per sqft)</th>
                        <th>Line Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalSQFT = 0;
                    @endphp
                    @foreach ($invoice->invoice_products as $item)
                        <tr>
                            <td>
                                <img style="filter: grayscale(1);" src="{{ asset('products/' . $item->product->image) }}"
                                    alt="Product image" width="100" height="150">
                            </td>
                            <td>
                                <b>
                                    {{ $item->product->name }} <br>
                                    <span>Dimensions (W x H) <br></span>
                                    {{ $item->width_in_feet . '\'.' . $item->width_in_inches }}"
                                    x{{ $item->height_in_feet . '\'.' . $item->height_in_inches }}"
                                </b>
                            </td>
                            <td>{{ number_format($item->totalSquareFeet(), 2) }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rs: {{ number_format($item->price, 2) }}</td>
                            <td>Rs: {{ number_format($item->totalSquareFeet() * $item->price * $item->qty, 2) }}</td>
                            @php
                                $totalSQFT += $item->totalSquareFeet() * $item->qty;
                            @endphp
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($totalSQFT,2) }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th style="text-align: right" colspan="5">Subtotal</th>
                        <th>Rs: {{ number_format($invoice->calculateSubtotal(), 2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: right" colspan="5">Discount </th>
                        <th>- Rs: {{ number_format($invoice->calculateDiscount(), 2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: right" colspan="5">Total After Discount</th>
                        <th>Rs: {{ number_format($invoice->calculateSubtotal() - $invoice->calculateDiscount(), 2) }}
                        </th>
                    </tr>
                    <tr>
                        <th style="text-align: right" colspan="5">Advance Payment</th>
                        <th>Rs: {{ number_format($invoice->advance, 2) }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: right" colspan="5">Balance Due</th>
                        <th>Rs: {{ number_format($invoice->calculateGrandTotal(), 2) }}</th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-title">Terms and Conditions</div>
            <div class="card-content">
                <p>1. All Invoices are valid for 30 days from the date of issue.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-title">Note</div>
            <p class="note-text">Please review the invoice carefully. If you have any questions or need further
                clarification, feel
                free to contact us.</p>
        </div>
    </div>
@endsection