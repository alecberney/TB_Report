<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('file_types', function (Blueprint $table) {
            $table->id();
            // Fields
            $table->string('name');
            $table->string('mime_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('file_types');
    }
};
