<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('dlicence');
            $table->string('email')->unique();
            $table->string('mobile');
            $table->string('password');
            $table->string('ttr');
            $table->string('ptc1');
            $table->string('ptc2');
            $table->string('ptc3');
            $table->string('tsooner');
            $table->string('tlater');
            $table->string('tduring');            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
