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
        Schema::table('complains', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_room_id')->nullable();
            $table->foreign('chat_room_id')
                ->references('id')
                ->on('chat_rooms')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('complains', function (Blueprint $table) {
            $table->dropColumn('chat_room_id');
        });
    }
};
