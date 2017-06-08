<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCachePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('route_name', 100)->unique();
            $table->string('description', 200);
            $table->boolean('is_cache_forever');
            $table->unsignedSmallInteger(   'cache_time')->comment('缓存时间,单位分钟');
            $table->integer('order')->default(0)->index()->comment('排序字段');
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
        Schema::dropIfExists('cache_pages');
    }
}
