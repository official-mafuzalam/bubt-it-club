<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('location');
            $table->string('image_url')->nullable();
            $table->enum('category', ['workshop', 'seminar', 'hackathon', 'competition', 'other']);
            $table->boolean('is_published')->default(false);
            $table->boolean('is_registration_open')->default(false);
            $table->boolean('is_paid')->default(false);
            $table->boolean('only_for_members')->default(false);
            $table->integer('max_participants')->nullable();
            $table->integer('registered_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
