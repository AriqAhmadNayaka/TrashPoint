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
        Schema::create('trash', function (Blueprint $table) {
            $table->id("idTrash");
            $table->string("province");
            $table->string("city");
            $table->string("roadAddress");
            $table->double("latitude", 9, 6);
            $table->double("longitude", 9, 6);
            $table->enum("status", ['empty', 'full', 'inactive'])->default('empty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trash');
    }
};
