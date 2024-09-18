<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvSettings\Theme;


class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'theme_id', 'status', 'total_price', 'payment_method'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
