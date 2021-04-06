<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintainanceProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintainance_providers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintainance_service_id')->references('id')
                ->on('maintainance_services')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->string('website');
            $table->text('description');
            $table->string('phone');
            $table->text('address');
            $table->double('lat');
            $table->double('long');
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
        Schema::dropIfExists('maintainance_providers');
    }
}
