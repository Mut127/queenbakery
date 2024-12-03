<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_id')->after('education')->nullable(); // Tambahkan kolom kategori_id
            $table->foreign('kategori_id')->references('id')->on('kategorilokers')->onDelete('set null'); // Definisi foreign key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelamars', function (Blueprint $table) {
            $table->dropForeign(['kategori_id']); // Hapus foreign key
            $table->dropColumn('kategori_id');   // Hapus kolom kategori_id
        });
    }
};
