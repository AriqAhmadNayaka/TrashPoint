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
        Schema::create('trash_schedule', function (Blueprint $table) {
            $table->id("idTrashSchedule");
            $table->bigInteger("idPetugas")->unsigned();
            $table->foreign("idPetugas")->references("idPetugas")->on("petugas")->onDelete("cascade");
            $table->bigInteger("idAdmin")->unsigned();
            $table->foreign("idAdmin")->references("idAdmin")->on("admin")->onDelete("cascade");
            $table->dateTime("scheduleDateTime");
            $table->enum("status", ['scheduled', 'completed', 'canceled'])->default('scheduled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash_schedule');
    }
};
