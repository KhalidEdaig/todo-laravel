<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedbyAffectedbyAffectedtoToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->bigInteger("createdBy_id")->default(0)->after('done');
            $table->bigInteger("affectedBy_id")->default(0)->after('createdBy_id');
            $table->bigInteger("affectedTo_id")->default(0)->after('affectedBy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->dropColumn("createdBy_id");
            $table->dropColumn("affectedBy_id");
            $table->dropColumn("affectedTo_id");
        });
    }
}
