<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_banner', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('page_name');
            $table->string('title')->nullable();
            $table->string('banner_image')->nullable();
            $table->longText('description')->nullable();
            $table->text('sub_description')->nullable();
            $table->string('button_title')->nullable();
            $table->string('link_redirect')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ms_banner');
    }
}
