<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'banners', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url');
                $table->string('title')->nullable();
                $table->string('picture', 32);
                $table->unsignedInteger('type_id')->nullable()->index();
                $table->integer('order')->default(0)->index()->comment('排序字段');
                $table->boolean('is_visible')->default(true);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
