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
        Schema::create('verification_code', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->char('code', 6);
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('thumbnail_path')->nullable();
            $table->smallInteger('rating')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_code');
        Schema::dropIfExists('book');
    }
};
