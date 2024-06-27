<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code',20);
            $table->string('name', 50);
            $table->string('description',150);
            $table->float('stock',19.2)->default(0);
            $table->float('price',19.2)->default(0);
            $table->float('cost',19.2)->default(0);
            $table->foreignIdFor(Category::class, 'category_id');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
