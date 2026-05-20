<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('craftsmen', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('image');
            $table->text('quote');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('craftsmen');
    }
};