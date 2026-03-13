<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('must_try', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->enum("type", ["dish", "place", "activity"])->nullable(null);

            $table->unsignedBigInteger("destination_id");
            $table->foreign("destination_id")->references("id")->on("destinations")->onDelete("cascade");
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('must_try');
    }
};
