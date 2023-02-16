<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->increments('id_party');
            
           
            $table->string('code_party');
            $table->string('code_daftar_muat');
            $table->Integer('nomor_sa');

            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('telepon_customer');

            $table->integer('nama_barang');
            $table->integer('jumlah_barang');
            $table->integer('berat_barang');
            
            $table->string('nama_penerima');
            $table->string('alamat_penerima');
            $table->string('telepon_penerima');
           
           
            $table->string('supir');
            $table->string('no_mobil');
            $table->text('keterangan');

            $table->timestamp('tanggal_pengambilan')->nullable();
            $table->timestamp('tanggal_kirim')->nullable();
            $table->timestamp('tanggal_terima')->nullable();
            
            $table->integer('harga');
            $table->integer('total_harga');
            $table->integer('total_jumlah_sa');

            $table->integer('total_harga_dm');
            $table->integer('total_jumlah_dm');

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
        Schema::dropIfExists('parties');
    }
}
