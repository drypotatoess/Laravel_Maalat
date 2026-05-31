<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('blood_type')->nullable();
            $table->string('contact')->nullable();
            $table->string('address')->nullable();
            $table->string('diagnosis');
            $table->string('doctor')->nullable();
            $table->date('date_of_visit');
            $table->enum('status', ['Admitted', 'Outpatient', 'Discharged'])->default('Outpatient');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
