<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotationItemResource\Pages;
use App\Filament\Resources\QuotationItemResource\RelationManagers;
use App\Models\QuotationItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuotationItemResource extends Resource
{
    protected static ?string $model = QuotationItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('quotation_id')
                    ->label('Quotation')
                    ->required()
                    ->options(\App\Models\Quotation::pluck('quotation_number', 'id'))
                    ->searchable()
                    ->placeholder('Select a quotation'),
                Forms\Components\TextInput::make('width')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('height')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('specification')
                    ->maxLength(255),
                Forms\Components\TextInput::make('truss')
                    ->maxLength(255),
                Forms\Components\TextInput::make('shed')
                    ->maxLength(255),
                Forms\Components\TextInput::make('piller')
                    ->maxLength(255),
                Forms\Components\TextInput::make('thickness')
                    ->maxLength(255),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quotation_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('width')
                    ->searchable(),
                Tables\Columns\TextColumn::make('height')
                    ->searchable(),
                Tables\Columns\TextColumn::make('specification')
                    ->searchable(),
                Tables\Columns\TextColumn::make('truss')
                    ->searchable(),
                Tables\Columns\TextColumn::make('shed')
                    ->searchable(),
                Tables\Columns\TextColumn::make('piller')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thickness')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListQuotationItems::route('/'),
            'create' => Pages\CreateQuotationItem::route('/create'),
            'edit' => Pages\EditQuotationItem::route('/{record}/edit'),
        ];
    }
}
