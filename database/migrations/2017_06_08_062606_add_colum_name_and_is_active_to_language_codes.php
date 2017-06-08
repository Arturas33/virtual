<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumNameAndIsActiveToLanguageCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vr_language_codes', function (Blueprint $table) {
            $table->string('name', 255);
            $table->tinyInteger('is_active');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vr_language_codes', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('is_active');
        });
    }
}
