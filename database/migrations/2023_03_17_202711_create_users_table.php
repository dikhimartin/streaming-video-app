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
            $table->char('id_users', 10)->nullable(false);
            $table->char('username', 20)->nullable(true);
            $table->string('name', 50)->nullable(true);
            $table->string('password', 100)->nullable(true);
            $table->string('email', 100)->nullable(true);
            $table->string('telephone', 100)->nullable(true);
            $table->date('date_birth')->nullable(true);
            $table->string('address')->nullable(true);
            $table->enum('gender', ['L', 'P'])->nullable(true);
            $table->integer('id_level_user')->nullable(true);
            $table->string('image', 125)->nullable(true);
            $table->rememberToken();
            $table->char('created_by', 10)->nullable(true);
            $table->char('updated_by', 10)->nullable(true);
            $table->timestamps();
            $table->enum('status', ['Y', 'N'])->nullable(true);
            $table->string('additional', 100)->nullable(true);
            $table->primary('id_users');
            $table->unique('username');
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
