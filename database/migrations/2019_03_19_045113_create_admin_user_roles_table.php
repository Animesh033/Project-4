<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('admin_role_id'); //laravel 5.7
            $table->unsignedInteger('user_role_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('admin_id');
            $table->foreign('user_id')->references('user_id')->on('user_roles')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin_roles')->onDelete('cascade');
            $table->foreign('admin_role_id')->references('role_id')->on('admin_roles')->onDelete('cascade');
            $table->foreign('user_role_id')->references('role_id')->on('user_roles')->onDelete('cascade');
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
        Schema::dropIfExists('admin_user_roles');
    }
}
