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
            $table->unsignedInteger('author')->index();
            $table->string('title',100)->unique();
            // slug
            //$table->string('slug', 100)->unique()->nullable();
            // 摘要
            $table->string('excerpt', 512)->nullable();
            $table->longText('content');
            // 文章封面
            $table->char('cover', 40)->nullable();
            $table->char('status', 10)->default('publish');
            //post page(单页) //revision(修订) //attachment(附件)
            $table->char('type', 10)->default('post');
            // 浏览量
            $table->unsignedInteger('views_count')->default(0)->index();
            $table->boolean('allow_comment')->default(false);
            $table->unsignedInteger('comments_num')->default(0);
            // 文章置顶
            $table->timestamp('top')->nullable()->index();
            $table->unsignedInteger('order')->default(0)->index();
            // 内容模板
            $table->string('template', 30)->nullable();
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
