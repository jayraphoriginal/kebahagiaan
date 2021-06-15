<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->ondelete('cascade');
            $table->foreignId('pembayaran_id')->constrained()->ondelete('cascade');
            $table->double('total');
            $table->double('jumlah_bayar');
            $table->double('kembalian');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_invoices');
    }
}
