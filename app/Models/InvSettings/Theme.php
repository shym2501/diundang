<?php

namespace App\Models\InvSettings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'path'];

    public function orders()
    {
        return $this->hasOne(Order::class);
    }
}
