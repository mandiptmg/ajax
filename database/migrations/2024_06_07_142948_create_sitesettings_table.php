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
        Schema::create('sitesettings', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->string('email');

            $table->string('contanct');

            $table->string('panno')->nullable();

            $table->string('contacttwo')->nullable();

            $table->string('address');

            $table->text('description');

            $table->text('map')->nullable();

            $table->text('logo');

            $table->text('favicon');

            $table->string('facebook')->nullable();

            $table->string('twitter')->nullable();

            $table->string('youtube')->nullable();

            $table->string('instagram')->nullable();

            $table->string('linkdln')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sitesettings');
    }
};
