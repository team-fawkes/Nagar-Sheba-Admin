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
        Schema::create('councilors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ward_id');
            $table->string('name_en');
            $table->string('name_bn');
            $table->string('title_en');
            $table->string('title_bn');
            $table->string('parliament_members_en')->nullable();
            $table->string('parliament_members_bn')->nullable();
            $table->text('details_en')->nullable();
            $table->text('details_bn')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ward_id')
                ->references('id')
                ->on('wards')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('councilors');
    }
};
