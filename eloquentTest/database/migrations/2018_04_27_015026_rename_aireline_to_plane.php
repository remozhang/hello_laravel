<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAirelineToPlane extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flights', function (Blueprint $table) {
            //
            $table->renameColumn('airline', 'plane');
            $table->string("name", '60')->change();
            $table->string('login_at', 120);

            // build foreign key constraints
            $table->foreign('name')->references('id')->on('post');

            // you can enable disable foreign key constraint
            Schema::enableForeignKeyConstraints();
            Schema::disableForeignKeyConstraints();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flights', function (Blueprint $table) {
            //
        });
    }
}
