<?php

use App\Models\Post;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            // $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Foreign key for the related post
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key for the author of the comment
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->text('body'); // Content of the comment
            $table->enum('stat', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('set null'); // Foreign key for the parent comment to allow multiple responses
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); // Foreign key for the related post
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Foreign key for the author of the comment
            $table->timestamps();
            $table->softDeletes(); // To keep track of soft deletions
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};