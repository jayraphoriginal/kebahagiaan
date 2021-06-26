<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ingredient;

class StokBahanComponent extends Component
{
    public $stokakhir, $stok, $tambah, $nama_bahan, $menu_id;

    public function render()
    {
        return view('livewire.stok-bahan-component',[
            'bahan' => Ingredient::paginate(10)
        ]);
    }

    public function tambahStok($id){
        $bahan = Ingredient::find($id);
        $this->menu_id = $id;
        $this->nama_bahan = $bahan->nama_bahan;
        $this->stok = $bahan->stok;
        $this->stokakhir = $bahan->stok;
    }

    public function resetfield(){
        $this->menu_id = '';
        $this->nama_bahan = '';
        $this->stok = '';
        $this->tambah = '';
        $this->stokakhir = '';
    }

    public function save(){
        $bahan = Ingredient::find($this->menu_id);
        $bahan['stok'] = $bahan['stok'] + $this->tambah;
        $bahan->save();
    }

    public function hitung(){
        if (!is_numeric($this->tambah)){
            $this->tambah = 0;
        }
        $this->stokakhir = $this->stok + $this->tambah;
    }


}
