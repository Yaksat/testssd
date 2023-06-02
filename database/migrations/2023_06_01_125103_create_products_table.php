<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('main_image')->nullable();
            $table->string('preview_image')->nullable();
            $table->string('name');
            $table->decimal('amount')->unsigned();
            $table->text('content');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('size');
            $table->softDeletes();

            $table->index('category_id', 'product_category_idx');
            $table->foreign('category_id', 'product_category_fk')->on('categories')->references('id');
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
        Schema::dropIfExists('products');
    }
};
