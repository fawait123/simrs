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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('patientID');
            $table->integer('doctorID')->nullable();
            $table->integer('clinicID')->nullable();
            $table->string('registrationID');
            $table->string('medicalID')->nullable();
            $table->date('registrationDate');
            $table->date('checkDate')->nullable();
            $table->time('chekTime')->nullable();
            $table->enum('status',['Umum','BPJS Kesehatan'])->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
