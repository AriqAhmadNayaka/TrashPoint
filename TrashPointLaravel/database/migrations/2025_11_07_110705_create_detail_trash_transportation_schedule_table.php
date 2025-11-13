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
        Schema::create('detail_trash_schedule', function (Blueprint $table) {
            $table->id("idDetailTrashSchedule");
            $table->bigInteger("idTrashSchedule")->unsigned();
            $table->foreign("idTrashSchedule")->references("idTrashSchedule")->on("trash_schedule")->onDelete("cascade");
            $table->bigInteger("idTrash")->unsigned();
            $table->foreign("idTrash")->references("idTrash")->on("trash")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_trash_schedule');
    }
};
