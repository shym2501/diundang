<?php

namespace App\Filament\Clusters\Customers\Resources;

use App\Filament\Clusters\Customers\Resources\CustomerResource\Pages;
use App\Filament\Clusters\Customers\Resources\CustomerResource\RelationManagers;
use App\Filament\Clusters\Customers;
use App\Models\Customers\Customer;
use App\Models\Customers\Order;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SubNavigationPosition;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Customer';

    protected static ?string $slug = 'customer';

    protected static ?int $navigationSort = 1;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $cluster = Customers::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
                TextInput::make('phone_number')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('password')
                    ->label('Password')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('phone_number')
                    ->label('Phone Number')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Create Order')
                    ->label('Create Order')
                    ->icon('heroicon-o-plus')  // Menambahkan ikon (opsional)
                    ->action(function ($record) {
                        // Membuat order baru dengan customer_id dari $record
                        Order::create([
                            'customer_id' => $record->id,
                            'theme_id' => 1,  // Ubah sesuai kebutuhan
                            'status' => 'pending',  // Status default
                            'total_price' => 0,  // Set harga default atau logika lainnya
                            'payment_method' => 1,  // Ubah sesuai kebutuhan
                        ]);
                    })
                    ->requiresConfirmation()  // Tambahkan konfirmasi sebelum menjalankan aksi
                    ->color('success'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCustomers::route('/'),
        ];
    }
}
