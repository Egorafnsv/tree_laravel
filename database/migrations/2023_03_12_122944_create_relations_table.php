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
        Schema::create('relations', function (Blueprint $table) {
            $table->integer('parent_id');
            $table->integer('child_id')->unique(); // каждый "узел" встречается только один раз в качестве потомка
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations');
    }
};
