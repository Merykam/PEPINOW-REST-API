<?php

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
        Schema::create('plantes', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('description');
            $table->decimal('price');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
           // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plantes', function (Blueprint $table) {
            Schema::dropIfExists('plantes');
        });
    }
};
