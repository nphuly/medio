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
        // Patients
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('email')->unique()->nullable();
        });

        // Patient phones
        Schema::create('patient_phones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');
            $table->string('phone_type');
            $table->string('phone_number');
            $table->boolean('is_main')->default(false);

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        // Patient addresses
        Schema::create('patient_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');
            $table->tinyInteger('address_type');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('region');
            $table->string('postal_code')->nullable();
            $table->string('country');

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });

        // Doctors
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob');
            $table->string('gender');
            $table->string('email')->unique()->nullable();
            $table->string('speciality');
            $table->string('work_schedule');
        });

        // Doctor phones
        Schema::create('doctor_phones', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id');
            $table->string('phone_type');
            $table->string('phone_number');
            $table->boolean('is_main')->default(false);

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });

        // Patient addresses
        Schema::create('doctor_addresses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id');
            $table->tinyInteger('address_type');
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->string('city');
            $table->string('region');
            $table->string('postal_code')->nullable();
            $table->string('country');

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });

        // Medical conditions
        Schema::create('medical_conditions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code');
            $table->string('name');
            $table->text('description')->nullable();
        });

        // Patient background conditions
        Schema::create('patient_background_conditions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('medical_condition_id');
            $table->text('notes')->nullable();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->foreign('medical_condition_id')->references('id')->on('medical_conditions')->onDelete('cascade');
        });

        // Appointments
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->dateTime('appointment_datetime');
            $table->string('status');
            $table->string('priority');
            $table->text('cancellation_reason')->nullable();
            $table->text('comments')->nullable();

            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('set null');
        });

        // Visits
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->dateTime('visit_date')->nullable();
            $table->text('symptoms')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment')->nullable();
            $table->text('notes')->nullable();
            $table->date('come_back_date')->nullable();
            $table->string('status');

            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('set null');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });

        // Medicines
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('generic_name')->nullable();
            $table->string('code')->nullable();
            $table->string('form');
            $table->string('strength');
            $table->string('manufacturer');
            $table->text('description')->nullable();
        });

        // Prescriptions
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('visit_id')->nullable();
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->text('notes')->nullable();

            $table->foreign('visit_id')->references('id')->on('visits')->onDelete('set null');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });

        // Prescriptions items
        Schema::create('prescription_items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('medicine_id');
            $table->string('dosage');
            $table->string('duration');
            $table->text('instructions')->nullable();

            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_items');
        Schema::dropIfExists('prescriptions');
        Schema::dropIfExists('medicines');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('patient_background_conditions');
        Schema::dropIfExists('medical_conditions');
        Schema::dropIfExists('doctor_addresses');
        Schema::dropIfExists('doctor_phones');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('patient_addresses');
        Schema::dropIfExists('patient_phones');
        Schema::dropIfExists('patients');
    }

};
