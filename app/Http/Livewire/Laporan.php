<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class Laporan extends Component
{
    public $tglawal;
    public $tglakhir;
    public $laporan;

    public function render()
    {
        $this->laporan  = DB::table('m_invoices')
                ->join('d_invoices', 'd_invoices.m_invoice_id', 'm_invoices.id')
                ->join('pembayarans', 'm_invoices.pembayaran_id', 'pembayarans.id')
                ->join('users', 'm_invoices.user_id', 'users.id')
                ->join('menus', 'd_invoices.menu_id', 'menus.id')
                ->whereDate(DB::raw('date(m_invoices.created_at)'),array(date_create($this->tglawal),date_create($this->tglakhir)))
                ->get();

        return view('livewire.laporan');
    }

}
