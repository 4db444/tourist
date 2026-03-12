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
        Schema::create('itineraries_categories', function (Blueprint $table) {
            $table->unsignedBigInteger("itinerary_id");
            $table->unsignedBigInteger("category_id");

            $table->primary(["itinerary_id", "category_id"]);
            
            $table->foreign("itinerary_id")
                  ->references("id")
                  ->on("itineraries")
                  ->onDelete("cascade");
            $table->foreign("category_id")
                  ->references("id")
                  ->on("categories")
                  ->onDelete("cascade");
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itineraries_categories');
    }
};
