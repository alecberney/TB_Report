<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            // Fields
            $table->string('name');
            $table->string('image_path');
            $table->longText('description');
        });
    }

    public function down()
    {
        Schema::dropIfExists('devices');
    }
};
