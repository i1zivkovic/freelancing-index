<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('job_status_id');
            $table->foreign('job_status_id')->references('id')->on('job_statuses')->onDelete('cascade');
            $table->string('title',200);
            $table->string('description',1000);
            $table->string('slug',500);
            $table->decimal('offer', 10,2);
            $table->boolean('is_per_hour');
            $table->string('job_location_country',200)->nullable();
            $table->string('job_location_city',100)->nullable();
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
        Schema::dropIfExists('jobs');
    }
}
