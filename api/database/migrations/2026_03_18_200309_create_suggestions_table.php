<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();

            $table->string('primary_name');
            $table->string('secondary_name')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamp('cached_at')->nullable();
            $table->integer('priority')->default(0);
            $table->string('type')->nullable();
            $table->json('metadata')->nullable();

            $table->timestamps();

            $table->index('primary_name');
            $table->index('type');
            $table->index('priority');
            $table->index('cached_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('suggestions');
    }
};
