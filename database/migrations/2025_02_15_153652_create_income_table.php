<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('income', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('income-category');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('income');
    }
};
