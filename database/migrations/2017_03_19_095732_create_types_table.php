<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 30);
            $table->string('description')->nullable();
            $table->unsignedInteger('order')->default(0)->index();
            $table->unsignedInteger('typeable_id');
            $table->string('typeable_type', 50);
            $table->index(['typeable_id', 'typeable_type']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
