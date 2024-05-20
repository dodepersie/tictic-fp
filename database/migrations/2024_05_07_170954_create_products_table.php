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
            $table->string('event_price');
            $table->string('event_location');
            $table->string('event_location_langitude');
            $table->string('event_location_latitude');
            $table->date('event_start_date');
            $table->string('event_image')->nullable();
            $table->timestamps();
    
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
