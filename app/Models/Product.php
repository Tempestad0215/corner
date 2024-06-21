<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'stock',
        'price',
        'cost'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];




    // Relaciones

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product){
            $product->code = self::generateCode();
        });
    }


    // funcion para generar el codigo
    private static function generateCode()
    {
        // Obtener el ultimo registros
        $last = self::orderBy('id','desc')->first();

        // Generar el proximo ID
        $nextID = $last ? $last->id +1 : 1;

        // Devolver los datos
        $code = config('code.product');

        // craer el codigp
        return $code.str_pad($nextID, 6,'0', STR_PAD_LEFT);
    }



}
