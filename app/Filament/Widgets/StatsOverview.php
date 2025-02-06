<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\Party;
use App\Models\Plai;
use App\Models\Product;
use App\Models\Quotation;
use App\Models\User;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Invoices', Invoice::count())
                ->icon('heroicon-o-document-text')
                ->color('success'),
            
            Stat::make('Total Customers', Customer::count())
                ->icon('heroicon-o-user-group')
                ->color('primary'),
            
            Stat::make('Total Quotations', Quotation::count())
                ->icon('heroicon-o-document')
                ->color('warning'),
            
            Stat::make('Total Users', User::count())
                ->icon('heroicon-o-users')
                ->color('secondary'),
            
            Stat::make('Total Transactions', Transaction::count())
                ->icon('heroicon-o-banknotes')
                ->color('danger'),

                Stat::make('Total Plai', Plai::count())
                ->icon('heroicon-o-play')
                ->color('indigo'),

            Stat::make('Total Party', Party::count())
                ->icon('heroicon-o-cog')
                ->color('teal'),

            Stat::make('Total Products', Product::count())
                ->icon('heroicon-o-cube')
                ->color('amber'),
        ];

    }
}
