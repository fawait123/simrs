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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->string('medicinalRecordID');
            $table->integer('patientID');
            $table->integer('doctorID');
            $table->string('complaint');
            $table->string('diagnosis');
            $table->string('goldar');
            $table->text('action');
            $table->text('medicine');
            $table->date('checkDate');
            $table->time('checkTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
