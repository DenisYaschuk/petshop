<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class AdminProductsComponent extends Component
{
    use WithPagination;

    public $product_id;

    public function deleteProduct()
    {
        $product = Product::find($this->product_id);
        $product->delete();
        session()->flash('success_message', 'Product has been deleted successfully!');
    }

    public function render()
    {
        $products = Product::orderBy('name', 'ASC')->paginate(20);
        return view('livewire.admin.admin-products-component', ['products' => $products]);
    }
}
