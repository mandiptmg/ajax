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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->string('image');
            $table->string('title_mission'); // Adjusted to use underscores for consistency
            $table->text('description_mission');
            $table->string('title_vision');
            $table->text('description_vision');
            $table->text('description_why');
            $table->string('title_support');
            $table->text('description_support');
            $table->string('title_team');
            $table->text('description_team');
            $table->string('title_code');
            $table->text('description_code');
            $table->text('image1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
