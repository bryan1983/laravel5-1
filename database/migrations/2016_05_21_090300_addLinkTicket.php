<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkTicket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Añadimos la columna Link a la tabla Tickets
        Schema::table('tickets', function(Blueprint $table){
           $table->string('link', '200')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Eliminamos la columna Link a la tabla Tickets
        Schema::table('tickets', function(Blueprint $table){
            $table->dropColumn('link');
        });
    }
}
