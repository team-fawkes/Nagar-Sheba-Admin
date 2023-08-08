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
        Schema::create('spectacular_places', function (Blueprint $table) {
            $table->id();
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('thumbnail')->nullable();
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->text('gallery')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->timestamp('established_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spectacular_places');
    }
};
