<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_author')->index();
            $table->string('post_title',200)->unique();
            // slug
            $table->string('post_slug', 200)->unique()->nullable();
            // 摘要
            $table->string('post_excerpt', 512)->nullable();
            $table->longText('post_content');
            // 文章封面
            $table->string('cover', 40)->nullable();
            $table->char('post_status', 10)->default('post');
            $table->char('post_type', 10)->default('publish');
            // 浏览量
            $table->unsignedInteger('views_count')->defaule(0)->index();
            $table->boolean('allow_comment')->default(0);
            $table->unsignedInteger('comments_num')->default(0);
            // 文章置顶
            $table->timestamp('top')->nullable()->index();
            $table->unsignedInteger('order')->default(0)->index();
            $table->unsignedInteger('parent')->default(0);
            //文章的一些其他配置
            $table->mediumText('setting')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
