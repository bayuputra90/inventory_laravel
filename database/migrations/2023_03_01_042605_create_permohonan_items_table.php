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
        Schema::create('permohonan_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barang_id')->constrained('barang')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('permohonan_id')->constrained('permohonan')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->string('satuan');
            $table->string('merk');
            $table->string('data_dukung')->nullable();
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
        Schema::dropIfExists('permohonan_items');
    }
};
