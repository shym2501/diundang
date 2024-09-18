<?php

namespace App\Filament\Clusters\Customers\Resources;

use App\Filament\Clusters\Customers\Resources\OrderResource\Pages;
use App\Filament\Clusters\Customers\Resources\OrderResource\RelationManagers;
use App\Filament\Clusters\Customers;
use App\Models\Customers\Order;
use App\Models\InvSettings\Theme;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Orders';

    protected static ?string $slug = 'orders';

    protected static ?int $navigationSort = 2;

    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    protected static ?string $cluster = Customers::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('customer_id')
                    ->required()
                    ->relationship('customer', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Select::make('theme_id')
                    ->required()
                    ->relationship('theme', 'name')
                    ->searchable()
                    ->preload()
                    ->native(false),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'cancel' => 'Cancel',
                    ])
                    ->default('pending'),
                TextInput::make('total_price')->numeric()->required(),
                TextInput::make('payment_method')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('customer.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('theme.name')
                    ->label('Theme Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),
                TextColumn::make('total_price')
                    ->label('Total Price')
                    ->sortable(),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageOrders::route('/'),
        ];
    }
}
