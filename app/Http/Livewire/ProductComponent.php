<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Cart;
use Livewire\Component;
use App\Models\Category;

class ProductComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        if (!$product) {
            abort(404);
        }
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->inRandomOrder()->limit(4)->get();

        $categories = Category::orderBy('name', 'ASC')->limit(10)->get();

        $product_images = array();
        $filesInFolder = \File::files(public_path('assets/imgs/products/' . $product->id));
        foreach ($filesInFolder as $path) {
            $file = pathinfo($path);
            $product_images[] = $file['filename']. '.' .$file['extension'];
        }
        return view(
            'livewire.product-component',
            [
                'product' => $product,
                'related_products' => $related_products,
                'categories' => $categories,
                'product_images' => $product_images,
            ]
        );
    }
}
