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
        Schema::create('Employee_kpi_evaluation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id'); 
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('kpi_id'); 
            $table->foreign('kpi_id')->references('id')->on('kpis');
            $table->unsignedBigInteger('evaluation_id'); 
            $table->foreign('evaluation_id')->references('id')->on('evaluations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Employee_kpi_evaluation~');
    }
};
