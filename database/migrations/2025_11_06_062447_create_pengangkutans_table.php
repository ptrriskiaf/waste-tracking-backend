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
        Schema::create('pengangkutan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id')->constrained('perusahaan')->onDelete('cascade');
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->onDelete('cascade');
            $table->foreignId('jasa_id')->constrained('jasa_pengangkutan')->onDelete('restrict');
            $table->date('tanggal_pengangkutan');
            $table->text('asal');
            $table->text('tujuan');
            $table->enum('status', ['dijadwalkan', 'berjalan', 'selesai', 'dibatalkan'])->default('dijadwalkan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengangkutans');
    }
};
