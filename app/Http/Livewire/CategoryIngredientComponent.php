<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Komposisi;
use App\Models\Ingredient;
use App\Models\Category;

class CategoryIngredientComponent extends Component
{
    public $category_id;
    public $bahan_id, $jumlah;
    public $category;


    public function mount($category_id){
        $this->category_id = decrypt($category_id);
        $categories = Category::find($this->category_id);
        $this->category = $categories->category;
    }

    protected $rules = [
        'bahan_id' => 'required',
        'jumlah' => 'required|numeric'
    ];

    public function render()
    {
        return view('livewire.category-ingredient-component',[
            'bahan' => Ingredient::all(),
            'komposisi' => Komposisi::select('komposisis.*', 'ingredients.nama_bahan')
            ->join('ingredients','komposisis.ingredient_id','ingredients.id')
            ->where('category_id',$this->category_id)->get()
        ]);
    }

    public function reset_data(){
        $this->bahan_id='';
        $this->jumlah='';
    }


    public function save(){

        $this->validate();

        Komposisi::Create([
            'category_id' => $this->category_id,
            'ingredient_id' => $this->bahan_id,
            'jumlah' => $this->jumlah,
        ]);
        
        session()->flash('message', $this->category_id ? 'Komposisi berhasil diubah' : 'Komposisi berhasil ditambahkan');
        $this->reset_data();
    }

    public function delete($id)
    {
        $komposisi = Komposisi::find($id); 
        $komposisi->delete();
        $this->reset_data();
    }
}
