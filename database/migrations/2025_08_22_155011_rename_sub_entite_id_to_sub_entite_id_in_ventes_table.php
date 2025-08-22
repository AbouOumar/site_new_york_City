<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
    public function up()
{
    Schema::table('ventes', function (Blueprint $table) {
        $table->renameColumn('subEntite_id', 'sub_entite_id');
    });
}

public function down()
{
    Schema::table('ventes', function (Blueprint $table) {
        $table->renameColumn('sub_entite_id', 'subEntite_id');
    });
}

};
