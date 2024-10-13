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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->string('event_title');
            $table->string('slug')->unique();
            $table->text('event_detail');
            $table->integer('event_price');
            $table->string('event_location');
            $table->decimal('event_location_longitude', 10, 7); // Longitude dalam format desimal
            $table->decimal('event_location_latitude', 10, 7); // Latitude dalam format desimal
            $table->date('event_start_date');
            $table->string('event_image')->nullable();
            $table->timestamps();
    
            // Definisi foreign key yang menghubungkan ke tabel merchants
            $table->foreign('merchant_id')->references('id')->on('merchants')->onDelete('cascade');
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
