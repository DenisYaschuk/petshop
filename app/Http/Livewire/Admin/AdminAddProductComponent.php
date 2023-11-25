<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminAddProductComponent extends Component
{
    use WithFileUploads;

    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $price;
    public $SKU;
    public $stock_status = 'in_stock';
    public $quantity;
    public $images;
    public $category_id;

    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'short_description' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'SKU' => 'required',
            'quantity' => 'required',
            'images.*' => 'required|image',
        ]);
    }

    public function addProduct()
    {
        $this->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'short_description' => 'required|max:255',
            'description' => 'required',
            'price' => 'required',
            'SKU' => 'required',
            'quantity' => 'required',
            'images.*' => 'required|image',
        ]);
        $product = new Product();
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->quantity = $this->quantity;
        $product->category_id = $this->category_id;
        $product->save();
        $counter = 0;
        foreach ($this->images as $image) {
            $imageName = Carbon::now()->timestamp . '-' . ++$counter . '.' . $image->extension();
            $image->storeAs('products/' . $product->id, $imageName);
        }
        session()->flash('success_message', 'Product has been created successfully!');
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view(
            'livewire.admin.admin-add-product-component',
            [
                'categories' => $categories
            ]
        );
    }
}
