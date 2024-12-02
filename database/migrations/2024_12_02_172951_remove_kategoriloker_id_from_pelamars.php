<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveKategorilokerIdFromPelamars extends Migration
{
    public function up()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropForeign(['kategoriloker_id']);  // Menghapus foreign key
            $table->dropColumn('kategoriloker_id');    // Menghapus kolom kategoriloker_id
        });
    }

    public function down()
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->unsignedBigInteger('kategoriloker_id')->nullable()->after('position');  // Menambahkan kolom kembali
            $table->foreign('kategoriloker_id')->references('id')->on('kategorilokers')->onDelete('set null');  // Menambahkan relasi foreign key kembali
        });
    }
}
