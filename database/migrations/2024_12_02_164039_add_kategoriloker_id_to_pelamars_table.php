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
        Schema::table('pelamars', function (Blueprint $table) {
            $table->unsignedBigInteger('kategoriloker_id')->nullable()->after('position');
            $table->foreign('kategoriloker_id')->references('id')->on('kategorilokers')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropForeign(['kategoriloker_id']);
            $table->dropColumn('kategoriloker_id');
        });
    }
};
