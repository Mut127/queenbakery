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
        Schema::table('cutis', function (Blueprint $table) {
            $table->string('status')->default('Pending'); // Menambahkan kolom 'status' dengan default 'Pending'
        });
    }

    public function down()
    {
        Schema::table('cutis', function (Blueprint $table) {
            $table->dropColumn('status'); // Menghapus kolom 'status' saat rollback
        });
    }

};
