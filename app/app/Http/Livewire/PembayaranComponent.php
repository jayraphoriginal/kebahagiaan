<?php

namespace App\Http\Livewire;

use App\Models\Pembayaran;
use Livewire\Component;
use Livewire\WithPagination;

class PembayaranComponent extends Component
{

    use WithPagination;
    public $Pembayaran_id, $nomor_pelanggan, $nama_pembayaran, $nama_akun;
    public $showmodal = false;

    protected $rules = [
        'nama_pembayaran' => 'required',
        'nomor_pelanggan' => 'required',
        'nama_akun' => 'required',
    ];

    public function render()
    {
        return view('livewire.pembayaran-component',[
            'pembayaran' => Pembayaran::paginate(10)
        ]);
    }

    public function reset_data(){
        $this->Pembayaran_id='';
        $this->nama_pembayaran='';
        $this->nomor_pelanggan='';
        $this->nama_akun='';
    }

    public function save(){

       $this->validate();

       Pembayaran::updateOrCreate(['id' => $this->Pembayaran_id],[
           'nama_pembayaran' => $this->nama_pembayaran,
           'nomor_pelanggan' => $this->nomor_pelanggan,
           'nama_akun' => $this->nama_akun,
           'saldo' => 0
       ]);
       
       session()->flash('message', $this->Pembayaran_id ? 'Pembayaran berhasil diubah' : 'Pembayaran berhasil ditambahkan');
       $this->reset_data();
    }

    public function edit($id)
    {
        $Pembayaran = Pembayaran::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->Pembayaran_id = $id;
        $this->nama_pembayaran = $Pembayaran->nama_pembayaran;
        $this->nomor_pelanggan = $Pembayaran->nomor_pelanggan;
        $this->nama_akun = $Pembayaran->nama_akun;
    }

    public function delete($id)
    {
        $Pembayaran = Pembayaran::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $Pembayaran->delete();
        $this->reset_data();
    }
}
