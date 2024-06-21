<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;


    // Datos para llenar
    protected $fillable = [
        'name',
        'description'
    ];



    // Formatear los datos
    protected $casts = [
        'status' => 'boolean'
    ];



    // Relaciones

    public function products():HasMany
    {
        return $this->hasMany(Product::class);
    }



    // Llamr el boot
    public static function boot()
    {
        parent::boot();


        static::creating(function ($category){
            $category->code = self::generateCode();
        });
    }


    private static function generateCode()
    {
        // Obtener el ultimo registros
        $last = self::orderBy('id','desc')->first();

        // Generar el proximo ID
        $nextID = $last ? $last->id +1 : 1;

        // Devolver los datos
        $code = config('code.category');

        // craer el codigp
        return $code.str_pad($nextID, 3,'0', STR_PAD_LEFT);

    }

}
