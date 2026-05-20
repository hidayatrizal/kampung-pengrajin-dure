<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('craftsmen', function (Blueprint $table) {
            $table->dropColumn(['role', 'quote']);
        });

        Schema::table('craftsmen', function (Blueprint $table) {
            $table->text('description')->nullable()->after('image');
            $table->string('address')->nullable()->after('description');
            $table->decimal('latitude', 10, 7)->nullable()->after('address');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            $table->integer('capacity')->nullable()->after('longitude');
            $table->string('price')->nullable()->after('capacity');
            $table->string('wa')->default('6281234567890')->after('price');
        });
    }

    public function down()
    {
        Schema::table('craftsmen', function (Blueprint $table) {
            $table->dropColumn(['description', 'address', 'latitude', 'longitude', 'capacity', 'price', 'wa']);
            $table->string('role')->default('Pengrajin')->after('name');
            $table->text('quote')->nullable()->after('image');
        });
    }
};