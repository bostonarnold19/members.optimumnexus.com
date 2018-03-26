<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunnelPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funnel_page', function (Blueprint $table) {
            $table->integer('funnel_id')->unsigned();
            $table->integer('page_id')->unsigned();
            $table->foreign('funnel_id')->references('id')->on('funnels')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('page_id')->references('id')->on('pages')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['funnel_id', 'page_id']);
            $table->string('rank')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funnel_page');
    }
}
