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
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('nature_of_leave_id');
            $table->unsignedBigInteger('department_id');
            $table->integer('number_days');
            $table->string('from');
            $table->string('to');
            $table->text('reason');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
