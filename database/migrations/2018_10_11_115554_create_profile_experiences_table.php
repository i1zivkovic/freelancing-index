<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->string('company_name', 100);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('job_title',100);
            $table->string('job_description',4000);
            $table->string('job_location_city',100)->nullable();
            $table->string('job_location_state',100)->nullable();
            $table->string('job_location_country',100)->nullable();
            $table->boolean('is_remote')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_experiences');
    }
}
