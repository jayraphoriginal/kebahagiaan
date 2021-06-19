<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
    public function index($id){

        $order = DB::table('m_invoices')
                ->join('d_invoices', 'd_invoices.m_invoice_id', 'm_invoices.id')
                ->join('pembayarans', 'm_invoices.pembayaran_id', 'pembayarans.id')
                ->join('users', 'm_invoices.user_id', 'users.id')
                ->join('menus', 'd_invoices.menu_id', 'menus.id')
                ->where('m_invoices.id', decrypt($id))
                ->get();

                //return $order;

        return view('invoice')->with('order', $order);

    }
}
