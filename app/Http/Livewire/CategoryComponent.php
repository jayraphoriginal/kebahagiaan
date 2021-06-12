<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class CategoryComponent extends Component
{

    use WithPagination;
    public $category_id, $category;
    public $showmodal = false;

    public function render()
    {
        return view('livewire.category-component',[
            'categories' => Category::paginate(10)
        ]);
    }

    protected $rules = [
        'category' => 'required|min:2',
    ];

    public function reset_data(){
        $this->category_id='';
        $this->category='';
    }

    public function save(){

       $this->validate();

       Category::updateOrCreate(['id' => $this->category_id],[
           'category' => $this->category,
       ]);
       
       session()->flash('message', $this->category_id ? 'category berhasil diubah' : 'category berhasil ditambahkan');
       $this->reset_data();
    }

    public function edit($id)
    {
        $category = Category::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->category_id = $id;
        $this->category = $category->category;
    }

    public function delete($id)
    {
        $category = Category::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $category->delete();
        $this->reset_data();
    }
}
