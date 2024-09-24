<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    // Campos que se pueden llenar de forma masiva
    protected $fillable = [
        'product_name',
        'quantity',
        'price',
    ];
}
