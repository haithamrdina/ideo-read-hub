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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('productId')->unique();
            $table->bigInteger('ownerId')->nullable();
            $table->text('title')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnailUrl')->nullable();
            $table->datetime('onlineDate')->nullable();
            $table->datetime('publishDate')->nullable();
            $table->time('estimatedReadTime')->nullable();
            $table->integer('nbPages')->nullable();
            $table->text('authors')->nullable();
            $table->string('ownerUsername')->nullable();
            $table->string('ownerDisplayableUserName')->nullable();
            $table->string('language')->nullable();
            $table->string('link')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('catalogues');
            $table->foreignId('theme_id')->nullable()->constrained('catalogues');
            $table->foreignId('tag_id')->nullable()->constrained('catalogues');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
