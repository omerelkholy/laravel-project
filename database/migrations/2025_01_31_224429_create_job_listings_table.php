<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobListingsTable extends Migration
{
    public function up()
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ensure this exists
            $table->string('title');
            $table->text('description');
            $table->text('requirements');
            $table->text('benefits');
            $table->string('salary_range');
            $table->string('location');
            $table->enum('work_type', ['remote', 'on_site', 'hybrid']);
            $table->date('application_deadline');
            $table->string('company_logo')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_listings');
    }
}