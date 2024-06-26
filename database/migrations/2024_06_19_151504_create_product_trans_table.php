<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_trans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class,'product_id');
            $table->float('quantity',19.2);
            $table->float('price',19.2);
            $table->float('cost',19.2);
            $table->enum('operation', [1,2,3,4,5]);
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_trans');
    }
};
