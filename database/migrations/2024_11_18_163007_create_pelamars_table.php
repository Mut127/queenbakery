<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelamarsTable extends Migration
{
    public function up()
    {
        Schema::create('pelamars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dob');
            $table->string('address');
            $table->string('education');
            $table->string('institution_name');
            $table->string('entry_year');
            $table->string('exit_year');
            $table->string('position');
            $table->string('company_name');
            $table->string('work_entry_year');
            $table->string('work_exit_year');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pelamars');
    }
}