<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Menu;
use App\Models\TmpOrder;
use DB;
use App\Models\Pembayaran;
use App\Models\MInvoice;
use App\Models\DInvoice;
use Exception;

class OrderComponent extends Component
{
    public $search;
    public $total;
    public $bayar;
    public $kembalian;
    public $pembayaran_id;
    public $showprint;
    public $invoice_id;
    public $disc;
    Public $grandtotal;

    public function render()
    {

        $this->total = TmpOrder::where('user_id', Auth()->user()->id)->sum(DB::raw('jumlah*harga'));
        $this->grandtotal = floatval($this->total) - (floatval($this->total) * floatval($this->disc) /100);
        $this->total = number_format(floatval(str_replace('.','',$this->total)),0,',','.');
        $this->grandtotal = number_format(floatval(str_replace('.','', $this->grandtotal)),0,'.','.');



        $this->kembalian = number_format(floatval(str_replace('.','',$this->bayar))- floatval(str_replace('.','',$this->grandtotal)),0,',','.');


        if (empty($this->search)){
            return view('livewire.order-component',[
                'menus' => Menu::all(),
                'tmp' => TmpOrder::select('tmp_orders.*','menus.nama_menu','menus.harga')
                ->where('user_id', Auth()->user()->id)->join('menus','tmp_orders.menu_id','menus.id')->get(),
                'pembayarans' => Pembayaran::all()
            ]);
        }

        return view('livewire.order-component',[
            'menus' => Menu::where('nama_menu', 'like', '%'.$this->search.'%')->get(),
            'tmp' => TmpOrder::select('tmp_orders.*','menus.nama_menu','menus.harga')
                ->where('user_id', Auth()->user()->id)->join('menus','tmp_orders.menu_id','menus.id')->get(),
            'pembayarans' => Pembayaran::all()
        ]);
    }

    public function add($id){

        $data = Menu::find($id);

        $tmpdata = TmpOrder::where('user_id', Auth()->user()->id)->where('menu_id',$id)->get();
        if (count($tmpdata)>0){
            $tmp = TmpOrder::find($tmpdata[0]->id);
            $tmp['jumlah'] = $tmp['jumlah'] + 1;
            $tmp->save();
        }else{
            $tmp = new TmpOrder();
            $tmp['menu_id'] = $id;
            $tmp['jumlah'] = 1;
            $tmp['harga'] = $data->harga;
            $tmp['user_id'] = Auth()->user()->id;
            $tmp->save();
        }
    }

    public function increase($id){

        $tmp = TmpOrder::find($id);
        $tmp['jumlah'] = $tmp['jumlah'] + 1;
        $tmp->save();

    }

    public function decrease($id){

        $tmp = TmpOrder::find($id);
        if ($tmp['jumlah'] > 1){
            $tmp['jumlah'] = $tmp['jumlah'] - 1;
            $tmp->save();
        }else{
            $tmp->delete();
        }

    }

    public function delete($id){
        $tmp = TmpOrder::find($id);
        $tmp->delete();
    }

    public function numericFormat($key){

        if ($this->bayar==''){
            $this->bayar=0;
        }

        if (is_numeric($key)){
            $this->bayar=str_replace('.','',$this->bayar);
            $this->bayar=number_format(floatval($this->bayar),0,',','.');
        }else{
            $this->bayar=str_replace($key,'',$this->bayar);
            $this->bayar=str_replace('.','',$this->bayar);
            $this->bayar=number_format(floatval($this->bayar),0,',','.');
        }

    }

    public function save(){

        $this->bayar=floatval(str_replace('.','',$this->bayar));
        $this->kembalian=floatval(str_replace('.','',$this->kembalian));
        $this->total=floatval(str_replace('.','',$this->total));
        $this->disc=floatval(str_replace('.','',$this->disc));
        $this->grandtotal=floatval(str_replace('.','',$this->grandtotal));

        $this->validate([
            'bayar' => 'numeric|min:1000',
            'kembalian' => 'numeric|min:0',
            'total' => 'numeric|min:1',
            'pembayaran_id' => 'required'
        ]);

        DB::begintransaction();

        try{

            $master = new MInvoice();
            $master['user_id'] = Auth()->user()->id;
            $master['pembayaran_id'] = $this->pembayaran_id;
            $master['total'] = $this->total;
            $master['jumlah_bayar'] = $this->bayar;
            $master['kembalian'] = $this->kembalian;
            $master['disc'] = $this->disc;
            $master['grandtotal']=$this->grandtotal;
            $master->save();

            $pembayaran = Pembayaran::find($this->pembayaran_id);
            $pembayaran['saldo'] = $pembayaran['saldo'] + $this->grandtotal;
            $pembayaran->save();

            $datatmp = TmpOrder::where('user_id', Auth()->user()->id)->get();

            foreach($datatmp as $tmp){

                $detail = new DInvoice();
                $detail['m_invoice_id'] = $master->id;
                $detail['menu_id'] = $tmp->menu_id;
                $detail['jumlah'] = $tmp->jumlah;
                $detail['harga'] = $tmp->harga;
                $detail->save();
            }

            DB::table('tmp_orders')->where('user_id',Auth()->user()->id)->delete();
            DB::commit();

            $this->resetfield();
            $this->showprint = true;
            $this->invoice_id = $master->id;

        }catch(Exception $e){
            DB::rollback();
        }

        session()->flash('message', 'Order berhasil ditambahkan');

    }

    public function resetfield(){

        $this->total = '';
        $this->kembalian = '';
        $this->bayar = '';
        $this->pembayaran_id = '';
        $this->grandtotal = '';
        $this->disc ='';

    }

}
