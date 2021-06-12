<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Ingredient;
use Livewire\WithPagination;

class IngredientComponent extends Component
{
    use WithPagination;
    public $nama_bahan, $bahan_id;
    public $showmodal = false;


    protected $rules = [
        'nama_bahan' => 'required|min:2',
    ];

    public function render()
    {
        return view('livewire.ingredient-component',[ 
            'bahan' => Ingredient::paginate(10),
        ]);

    }

    public function reset_data(){
        $this->bahan_id='';
        $this->nama_bahan='';
    }

    public function save(){

       $this->validate();

       Ingredient::updateOrCreate(['id' => $this->bahan_id],[
           'nama_bahan' => $this->nama_bahan,
           'stok' => 0,
       ]);
       
       session()->flash('message', $this->bahan_id ? 'Bahan berhasil diubah' : 'Bahan berhasil ditambahkan');
       $this->reset_data();
    }

    public function edit($id)
    {
        $bahan = Ingredient::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->bahan_id = $id;
        $this->nama_bahan = $bahan->nama_bahan;
    }

    public function delete($id)
    {
        $bahan = Ingredient::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $bahan->delete();
        $this->reset_data();
    }

}
