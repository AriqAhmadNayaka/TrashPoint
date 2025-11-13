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
        Schema::create('history_take_out_trash', function (Blueprint $table) {
            $table->id("idHistoryTakeOutTrash");
            $table->bigInteger("idMasyarakat")->unsigned();
            $table->bigInteger("idTrash")->unsigned();
            $table->foreign("idMasyarakat")->references("idMasyarakat")->on("masyarakat")->onDelete("cascade");
            $table->foreign("idTrash")->references("idTrash")->on("trash")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_take_out_trash');
    }
};
