<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductLinkImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_link_images', function (Blueprint $table) {
            $table->id();
            $table->longText('product_lists');
            $table->text('images_path');
            $table->longText('placements');
            $table->text('Front');
            $table->text('Back');
            $table->text('Outside');
            $table->text('Inside label');
            $table->text('Left sleeve');
            $table->text('Right sleeve');
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
        Schema::dropIfExists('product_link_images');
    }
}
