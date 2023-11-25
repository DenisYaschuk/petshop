<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    public $name;
    public $slug;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
    }

    public function addCategory()
    {
        $this->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('success_message', 'Category has been created successfully!');
    }

    public function render()
    {
        return view('livewire.admin.admin-add-category-component');
    }
}
