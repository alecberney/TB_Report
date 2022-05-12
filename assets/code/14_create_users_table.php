<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('switch_uuid', 320)->unique()->primary();
            // Fields
            $table->string('email', 320)->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('password')->nullable();
            // Options
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
