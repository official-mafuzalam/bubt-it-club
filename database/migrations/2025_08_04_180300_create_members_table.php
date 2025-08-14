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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('student_id')->unique();
            $table->string('department');
            $table->string('intake');
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('position')->default('general_member');
            $table->text('bio')->nullable();
            $table->string('photo_url')->nullable();
            $table->json('social_links')->nullable();
            $table->json('favorite_categories')->nullable(); //like: ['coding', 'design', 'management'] 
            $table->boolean('is_active')->default(true);
            $table->date('joined_at');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
