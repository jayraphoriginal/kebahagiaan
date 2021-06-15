<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('d_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('m_invoice_id')->constrained()->ondelete('cascade');
            $table->foreignId('menu_id')->constrained()->ondelete('cascade');
            $table->integer('jumlah');
            $table->double('harga');
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
        Schema::dropIfExists('d_invoices');
    }
}
