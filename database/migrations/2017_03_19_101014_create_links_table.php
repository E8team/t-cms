<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'links', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url');
                $table->string('name', 20);
                $table->string('logo', 32)->nullable();
                $table->string('linkman', 30)->comment('联系人')->nullable();
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
        Schema::dropIfExists('links');
    }
}
