<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 60);
            $table->string('firstname', 60);
            $table->string('middlename', 60);
            $table->string('address', 60);
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                    ->references('id')->on('departments')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')
                    ->references('id')->on('cities')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')
                    ->references('id')->on('states')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            $table->string('zip', 10)->nullable();
            $table->date('birthday')->nullable();
            $table->date('date_hired')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('deleted_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}