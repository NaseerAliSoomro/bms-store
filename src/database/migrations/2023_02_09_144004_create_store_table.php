<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('contents');
            $table->bigInteger('id_company');
            $table->bigInteger('id_category');
            $table->integer('user_id');
            $table->longText('token');
            $table->longText('complete_setting')->nullable();
            $table->longText('all_items_json')->nullable();
            $table->longText('my_editing')->nullable();
            $table->longText('product_lists')->nullable();
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
        Schema::dropIfExists('store');
    }
}
