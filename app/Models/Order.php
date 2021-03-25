<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected array $fillable = ['user_id', 'phone', 'email', 'shipment_info', 'amount'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products')->withPivot('quantity');
    }

}

