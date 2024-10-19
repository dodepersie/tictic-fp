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
            $table->unsignedBigInteger('category_id');
            $table->string('event_title');
            $table->string('slug')->unique();
            $table->text('event_detail');
            $table->string('event_address');
            $table->string('event_location');
            $table->integer('event_price');
            $table->decimal('event_location_longitude', 10, 7);
            $table->decimal('event_location_latitude', 10, 7);
            $table->date('event_start_date');
            $table->date('event_end_date');
            $table->time('event_start_time');
            $table->string('event_image')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
