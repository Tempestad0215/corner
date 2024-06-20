<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTrans extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'cost',
        'status'
    ];
}
