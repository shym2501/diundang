<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

class InvSettings extends Cluster
{
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Inv Management';
    protected static ?string $navigationLabel = 'Inv Settings';
    protected static ?string $slug = 'invsettings';
    protected static ?int $navigationSort = 2;
}
