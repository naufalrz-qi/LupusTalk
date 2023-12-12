<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('notif_type', 50);
            $table->string('notif_content', 255);
            $table->string('notif_read', 20);
            $table->unsignedBigInteger('notif_by');
            $table->unsignedBigInteger('notif_to');

            $table->timestamps();

            $table->foreign('notif_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('notif_to')->references('id')->on('users')->onDelete('cascade');

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
