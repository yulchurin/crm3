<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->boolean('gender');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->date('date_of_birth');

            $table->string('phone', 10)->unique();
            $table->string('zip', 50)->nullable();
            $table->string('region', 255)->nullable();
            $table->string('city', 255)->nullable();
            $table->string('street', 255)->nullable();
            $table->string('house', 50)->nullable();
            $table->string('flat', 50)->nullable();

            $table->string('passport_series', 4);
            $table->string('passport_number', 6);
            $table->string('passport_issuer', 100);
            $table->date('passport_issuance_date');
            $table->string('place_of_birth', 100)->nullable();
            $table->string('snils', 11)->nullable()->unique();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
};
