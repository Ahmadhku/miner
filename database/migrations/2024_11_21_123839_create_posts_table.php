<?php

use App\Models\Category;
use App\Models\User;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body')->nullable();
            $table->string('excerpt', 300)->nullable(); // Short preview of the post
            $table->string('image')->nullable(); // Optional featured image URL or path
            $table->boolean('published')->default(true); // Status of the post (published or draft)
            $table->timestamp('published_at')->nullable(); // Publish date and time
            $table->timestamps();
            $table->softDeletes(); // To keep track of soft deletions
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};