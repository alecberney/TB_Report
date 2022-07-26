<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            // Fields
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->date('deadline');
            $table->unsignedTinyInteger('rating')->nullable();
            $table->float('working_hours', 4, 2, true)->nullable(); // unsigned
            $table->enum('status', ['new', 'validated', 'assigned', 'ongoing', 'on-hold', 'completed', 'closed'])->default('new');
            // Options
            $table->softDeletes();
            $table->timestamps();
            // Foreign keys
            $table->string('client_username', 17);
            $table->string('worker_username', 17)->nullable(); // Nullable because can / must be attributed later
            $table->string('validator_username', 17)->nullable(); // Nullable because can / must be attributed later

            $table->foreignId('job_category_id')->constrained();

            $table->foreign('client_username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('worker_username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('validator_username')->references('username')->on('users')->onDelete('cascade');
            // Indexes
            $table->index('job_category_id');
            $table->index('client_username');
            $table->index('worker_username');
            $table->index('validator_username');
        });
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('jobs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
