<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'settings', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 30)->unique();
                $table->text('value');
                $table->string('description')->nullable();
                $table->boolean('is_autoload')->default(true);
                $table->unsignedInteger('type_id')->nullable()->index();
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
        Schema::dropIfExists('settings');
    }
}
