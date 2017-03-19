<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('type')->comment('分类类型 0: 列表栏目 1: 单页栏目 2: 外部链接');
            // 缩略图
            $table->string('image', 40)->nullable();
            // 父级id
            $table->unsignedInteger('parent_id')->default(0);
            // 分类名
            $table->string('cate_name', 30);
            // 分类描述
            $table->string('description')->nullable();
            // 外部链接
            $table->string('url')->nullable();
            // 分类slug
            $table->string('cate_slug', 30)->nullable()->unique();
            // 是否在导航栏显示
            $table->boolean('is_menu')->defalut(false);
            $table->unsignedInteger('order')->defaule(0)->index();
            // 分类的一些其他配置
            $table->mediumText('setting')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
