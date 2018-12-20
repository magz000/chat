<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status')->default(1); // 0 => inactive, 1 => active
            $table->timestamps();
        });

        Schema::create('systems', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('status')->default(1); // 0 => inactive, 1 => active
            $table->timestamps();
        });

        Schema::create('group_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->integer('status')->default(1); // 0 => inactive, 1 => active
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');

            $table->foreign('system_id')
                ->references('id')
                ->on('systems')
                ->onDelete('cascade');
        });

        Schema::create('user_systems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('system_id')->unsigned();
            $table->integer('status')->default(1); // 0 => inactive, 1 => active
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('system_id')
                ->references('id')
                ->on('systems')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_systems');
        Schema::dropIfExists('user_systems');
        Schema::dropIfExists('systems');
        Schema::dropIfExists('groups');
    }
}
