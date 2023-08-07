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
        Schema::create('complain_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('complain_id');
            $table->string('file_path');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('complain_id')->references('id')->on('complains')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complain_files');
    }
};
