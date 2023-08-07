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
        Schema::create('complains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_category_id');
            $table->unsignedBigInteger('user_id');
            $table->string('complain_id')->unique();
            $table->string('title');
            $table->text('description');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('picture')->nullable();
            $table->string('voice')->nullable();
            $table->string('video')->nullable();
            $table->text('gallery')->nullable();
            $table->string('status')->default('pending')->comment('Status options: pending, received, progress, solved');
            $table->timestamp('received_at')->nullable();
            $table->timestamp('solved_at')->nullable();
            $table->timestamp('observed_at')->nullable();
            $table->softDeletes(); // Add soft delete column
            $table->timestamps();

            // Define foreign key constraint for service_category_id
            $table->foreign('service_category_id')
                ->references('id')
                ->on('service_categories')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complains');
    }
};
