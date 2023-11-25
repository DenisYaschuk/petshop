<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
{
    use WithPagination;
    public $pageSize = 10;
    public $sortingType = 'Featured';
    public $slug;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('shop.cart');
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function changePageSize($pageSize)
    {
        $this->pageSize = $pageSize;
    }

    public function changeSortingType($sortingType)
    {
        $this->sortingType = $sortingType;
    }

    public function render()
    {
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        switch ($this->sortingType) {
            case 'Price: Low to High':
                $products = Product::where('category_id', $category_id)->orderBy('price', 'ASC')->paginate($this->pageSize);
                break;
            case 'Price: High to Low':
                $products = Product::where('category_id', $category_id)->orderBy('price', 'DESC')->paginate($this->pageSize);
                break;
            case 'Release Date':
                $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
                break;
            default:
                $products = Product::where('category_id', $category_id)->orderBy('updated_at', 'DESC')->paginate($this->pageSize);
        }

        $categories = Category::orderBy('name', 'ASC')->get();

        return view(
            'livewire.category-component',
            [
                'products' => $products,
                'categories' => $categories,
                'category_name' => $category_name
            ]
        );
    }
}
