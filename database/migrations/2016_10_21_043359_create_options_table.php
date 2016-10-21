<?php

use App\Option;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
	    $table->string('name')->index();
	    $table->string('value');
            $table->timestamps();
        });

	Option::create(['name'=>'site_name' , 'value'=>'A NEW WZSM SITE']);
	Option::create(['name'=>'verify_articles' , 'value'=>'accept']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('options');
    }
}
