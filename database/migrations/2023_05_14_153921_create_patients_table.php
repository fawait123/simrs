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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('name');
            $table->string('gender');
            $table->string('placebirth');
            $table->string('birthdate');
            $table->string('age');
            $table->string('academic');
            $table->string('religion');
            $table->string('pekerjaan');
            $table->string('province');
            $table->string('district');
            $table->string('subdistrict');
            $table->string('village');
            $table->string('rtrw');
            $table->string('phone');
            $table->string('email');
            $table->string('photos');
            $table->string('ktp');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
