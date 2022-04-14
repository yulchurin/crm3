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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('active')->default(false);
            $table->foreignId('group_id')->nullable()->constrained();
            $table->string('google_id')->nullable();
            $table->string('vk_id')->nullable();
            $table->tinyInteger('role')->default(30);
            $table->string('phone', 10)->nullable();

            $table->foreignId('person_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('parent_id')->nullable();

            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('people')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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
        Schema::dropIfExists('users');
    }
};
