<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id');
            $table->integer('parent')->nullable();
            $table->string('name');
            $table->string('link')->nullable();
            $table->enum('type', ['nothing', 'link', 'page', 'scroll'])->default('nothing');
            $table->tinyInteger('new_window')->nullable();
            $table->integer('ord');
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
        Schema::dropIfExists('menu_items');
    }
}
