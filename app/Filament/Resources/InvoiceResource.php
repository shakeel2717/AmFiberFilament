<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use App\Models\InvoiceItem;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-receipt-refund';
    protected static ?string $navigationGroup = 'Finance  Management';
    public static ?string $navigationsort ='4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->label('Customer')
                    ->relationship('customer', 'name')
                    ->required(),

                Forms\Components\TextInput::make('invoice_number')
                    ->label('Invoice Number')
                    ->default(fn() => 'INV-' . now()->format('YmdHis')) // Auto-generate
                    ->readOnly()
                    ->required(),

                Forms\Components\DatePicker::make('invoice_date')
                    ->label('Invoice Date')
                    ->default(now())
                    ->required(),

                // Invoice Items
                Forms\Components\Repeater::make('items')
                    ->relationship('items')
                    ->label('Invoice Items')
                    ->schema([
                        Forms\Components\TextInput::make('description')
                            ->label('Item Description')
                            ->required(),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Quantity')
                            ->numeric()
                            ->default(1)
                            ->required(),

                        Forms\Components\TextInput::make('unit_price')
                            ->label('Unit Price')
                            ->numeric()
                            ->required(),

                        Forms\Components\TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->default(fn($get) => $get('quantity') * $get('unit_price'))
                            ->readOnly()
                            ->required(), // Ensure it is always present

                    ])
                    ->minItems(1)
                    ->required(),

                // Invoice Total (auto-calculated)
                Forms\Components\TextInput::make('total')
                    ->label('Total Amount')
                    ->numeric()
                    ->readOnly()
                    ->default(fn($get) => collect($get('items'))->sum(fn($item) => $item['quantity'] * $item['unit_price'])),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'pending' => 'Pending',
                    ])
                    ->default('unpaid')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('invoice_number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('invoice_date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),


            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
