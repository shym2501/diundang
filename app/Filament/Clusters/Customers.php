<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class Customers extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Customer Data';
    protected static ?string $navigationLabel = 'Customers';
    protected static ?string $slug = 'customers';
    protected static ?int $navigationSort = 1;
}
