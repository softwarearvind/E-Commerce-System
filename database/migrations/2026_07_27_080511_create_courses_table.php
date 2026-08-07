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
        Schema::create('courses', function (Blueprint $table) {
             $table->id();
             $table->foreignId('vendor_id')->constrained('users')->cascadeOnDelete();
             $table->foreignId('course_category_id')->constrained('course_categories')->cascadeOnDelete();
             $table->string('title');
             $table->string('slug')->unique();
             $table->string('thumbnail')->nullable();
             $table->text('description')->nullable();
             $table->decimal('price',10,2)->default(0);
            $table->enum('level',['Beginner', 'Intermediate','Advanced'])->default('Beginner');
            $table->enum('type',[ 'free','paid' ])->default('paid');
            $table->enum('status',['draft','published','inactive'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
