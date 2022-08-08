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
        Schema::create('research', function (Blueprint $table) {
            $table->id('id');
            $table-> date('Date');
            $table-> text('Title');
            $table-> text('Research_Name');
            $table-> text('Partner_Agency');
            $table-> text('Designation');
            $table-> date('Start_Date');
            $table-> date('Target_Date');
            $table-> text('CREC');
            $table-> text('URECOM');
            $table-> string('Fund');
            $table-> integer('Budget');
            $table-> text('Remarks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research');
    }
};
