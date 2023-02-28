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
        Schema::create('employee_kpi', function (Blueprint $table) {
            $table->id();
            $table->text('evaluation');
            $table->date('date');
            $table->unsignedBigInteger('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedBigInteger('kpi_id'); 
            $table->foreign('kpi_id')->references('id')->on('kpis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_kpi_evaluation');
    }
};
