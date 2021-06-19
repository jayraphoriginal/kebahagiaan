<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class Laporan extends Component
{
    public $tglawal;
    public $tglakhir;
    public $laporan;
    public $total;

    public function render()
    {
        $this->laporan  = DB::table('m_invoices')
                ->select('m_invoices.*', 'd_invoices.*', 'users.name', 'pembayarans.nama_pembayaran','menus.nama_menu')
                ->join('d_invoices', 'd_invoices.m_invoice_id', 'm_invoices.id')
                ->join('pembayarans', 'm_invoices.pembayaran_id', 'pembayarans.id')
                ->join('users', 'm_invoices.user_id', 'users.id')
                ->join('menus', 'd_invoices.menu_id', 'menus.id')
                ->whereBetween(DB::raw('date(m_invoices.created_at)'),array(date_create($this->tglawal)->format('Y-m-d'),date_create($this->tglakhir)->format('Y-m-d')))
                ->get();

        $this->total = DB::table('m_invoices')
        ->whereBetween(DB::raw('date(m_invoices.created_at)'),array(date_create($this->tglawal)->format('Y-m-d'),date_create($this->tglakhir)->format('Y-m-d')))
        ->sum('grandtotal');



        return view('livewire.laporan');
    }

}
