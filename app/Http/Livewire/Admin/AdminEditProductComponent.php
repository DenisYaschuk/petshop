<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminEditProductComponent extends Component
{
    use WithFileUploads;

    public $product_id;
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $price;
    public $SKU;
    public $stock_status;
    public $quantity;
    public $images;
    public $category_id;
    public $newImages;

    public function mount($product_id)
    {
        $product = Product::find($product_id);
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->short_description = $product->short_description;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->SKU = $product->SKU;
        $this->stock_status = $product->stock_status;
        $this->quantity = $product->quantity;
        $this->category_id = $product->category_id;
        $filesInFolder = \File::files(public_path('assets/imgs/products/' . $product_id));
        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $this->images[] = $file['filename']. '.' .$file['extension'];
        }
    }

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
            'newImages.*' => 'image',
        ]);
    }

    public function updateProduct()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'price' => 'required',
            'SKU' => 'required',
            'quantity' => 'required',
            'newImages.*' => 'image',
        ]);
        $product = Product::find($this->product_id);
        $product->name = $this->name;
        $product->slug = $this->slug;
        $product->short_description = $this->short_description;
        $product->description = $this->description;
        $product->price = $this->price;
        $product->SKU = $this->SKU;
        $product->stock_status = $this->stock_status;
        $product->quantity = $this->quantity;
        $product->category_id = $this->category_id;
        if ($this->newImages) {
            \File::deleteDirectory(public_path('assets/imgs/products/' . $this->product_id));
            $counter = 0;
            foreach ($this->newImages as $image) {
                $imageName = Carbon::now()->timestamp . '-' . ++$counter . '.' . $image->extension();
                $image->storeAs('products/' . $product->id, $imageName);
            }
        }
        $product->save();
        session()->flash('success_message', 'Product has been updated successfully!');
    }

    public function render()
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        return view(
            'livewire.admin.admin-edit-product-component',
            [
                'categories' => $categories
            ]
        );
    }
}
