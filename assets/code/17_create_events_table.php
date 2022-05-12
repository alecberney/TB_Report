<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // Fields
            $table->longText('data');
            // Options
            $table->timestamps();
            // Foreign keys
            $table->foreignId('job_id')
            ->constrained()->onDelete('cascade');
            // Indexes
            $table->index('job_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
