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
        Schema::create('history_voucher', function (Blueprint $table) {
            $table->id("idHistoryVoucher");
            $table->bigInteger("idMasyarakat")->unsigned();
            $table->foreign("idMasyarakat")->references("idMasyarakat")->on("masyarakat")->onDelete("cascade");
            $table->bigInteger("idVoucher")->unsigned();
            $table->foreign("idVoucher")->references("idVoucher")->on("voucher")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_voucher');
    }
};
