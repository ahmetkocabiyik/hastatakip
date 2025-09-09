<?php

use App\Enums\CorporateStatus;
use App\Enums\PatientSource;
use App\Enums\PatientStatus;
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
            $table->integer("number");
            $table->string("name");
            $table->string("gender");
            $table->string("id_no")->nullable();
            $table->date("birth_date")->nullable();
            $table->date("registration_date");
            $table->foreignId("city_id")->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId("country_id")->nullable()->constrained()->cascadeOnDelete();
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->foreignId("sgk_id")->nullable()->constrained()->cascadeOnDelete();
            $table->string("source")->default(PatientSource::Unknown);
            $table->text("allergies")->nullable();
            $table->text("drugs")->nullable();
            $table->text("past_operations")->nullable();
            $table->text("known_illness")->nullable();
            $table->text("complaint")->nullable();
            $table->timestamps();
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
