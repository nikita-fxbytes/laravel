<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->string('password', 60)->nullable();
            $table->string('Description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('inactive')->comment('active, inactive');
            $table->smallInteger('activestatus')->default(0)->comment('active=>1, inactive=>0');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('customers');
        Schema::table('customers', function(Blueprint $table)
        {
            $table->dropForeign('user_id');
        });
    }
}
