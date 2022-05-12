<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('job_categories', function (Blueprint $table) {
            $table->id();
            // Fields
            $table->string('acronym');
            $table->string('name');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_categories');
    }
};
