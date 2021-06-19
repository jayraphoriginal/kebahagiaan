<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Menu;
use Livewire\WithPagination;
use App\Models\Category;


class MenuComponent extends Component
{
    use WithPagination;
    public $menu_id, $category_id, $nama_menu, $harga, $picture;
    public $showmodal = false;
    public $categories;

    protected $rules = [
        'nama_menu' => 'required|min:2',
        'category_id' => 'required',
        'harga' => 'required|numeric',
    ];

    public function render()
    {

        $this->categories = Category::all();

        return view('livewire.menu-component',[ 
            'menu' => Menu::paginate(10),
        ]);
    }

    public function reset_data(){
        $this->menu_id='';
        $this->nama_menu='';
        $this->category_id='';
        $this->harga='';
    }

    public function save(){

       $this->validate();

       

       Menu::updateOrCreate(['id' => $this->menu_id],[
           'nama_menu' => $this->nama_menu,
           'category_id' => $this->category_id,
           'harga' => $this->harga,
       ]);
       
       session()->flash('message', $this->menu_id ? 'menu berhasil diubah' : 'menu berhasil ditambahkan');
       $this->reset_data();
    }

    public function edit($id)
    {
        $menu = Menu::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $this->menu_id = $id;
        $this->nama_menu = $menu->nama_menu;
        $this->category_id = $menu->category_id;
        $this->harga = $menu->harga;
    }

    public function delete($id)
    {
        $menu = Menu::find($id); //BUAT QUERY UTK PENGAMBILAN DATA
        //LALU ASSIGN KE DALAM MASING-MASING PROPERTI DATANYA
        $menu->delete();
        $this->reset_data();
    }
   
}
