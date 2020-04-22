<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counter')->default(0);
            $table->integer('reset_by')->nullable();
            $table->timestamps();
        });

        \App\Models\Counter::create(['counter' => 0]);

        \App\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$Mu9gJnTRZd9NGqfg3js.RO4ILbAvDKGRnSqqEcX1LxTezcWrR.d/2',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
