<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->unsignedBigInteger('penandatangan_id')->after('category_id');
            $table->string('tanggal_terbit')->after('penandatangan_id');

            $table->foreign('penandatangan_id')->references('id')->on('penandatangans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trainings', function (Blueprint $table) {
            $table->dropColumn('penandatangan_id');
            $table->dropColumn('tanggal_terbit');
        });
    }
};
