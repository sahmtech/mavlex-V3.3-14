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
        Schema::create('dashboard_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('business_id')->index('dashboard_configurations_business_id_foreign');
            $table->integer('created_by');
            $table->string('name');
            $table->string('color');
            $table->text('configuration')->nullable();
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
        Schema::dropIfExists('dashboard_configurations');
    }
};
