<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAirdevMedias extends Migration
{
    public function up()
    {
        Schema::create('airdev_medias', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('alt')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('airdev_medias');
    }
}
