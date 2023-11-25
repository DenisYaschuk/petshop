<?php


use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminAddInfoPageComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminCategoriesComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminEditInfoPageComponent;
use App\Http\Livewire\Admin\AdminEditMenuComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
use App\Http\Livewire\Admin\AdminInfoPagesComponent;
use App\Http\Livewire\Admin\AdminOrderDetailsComponent;
use App\Http\Livewire\Admin\AdminOrdersComponent;
use App\Http\Livewire\Admin\AdminProductsComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\ProductComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\InfoPageComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\ThankYouComponent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeComponent::class)->name('home.index');

Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');
Route::get('/thank-you', ThankYouComponent::class)->name('shop.thank-you');
Route::get('/product/{slug}', ProductComponent::class)->name('product.details');
Route::get('/category/{slug}', CategoryComponent::class)->name('category.details');
Route::get('/info/{slug}', InfoPageComponent::class)->name('info.details');

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');

    Route::get('/admin/products', AdminProductsComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('/admin/product/edit/{product_id}', AdminEditProductComponent::class)->name('admin.product.edit');

    Route::get('/admin/orders', AdminOrdersComponent::class)->name('admin.orders');
    Route::get('/admin/order/{order_id}', AdminOrderDetailsComponent::class)->name('admin.order.details');

    Route::get('/admin/info-pages', AdminInfoPagesComponent::class)->name('admin.info-pages');
    Route::get('/admin/info-page/add', AdminAddInfoPageComponent::class)->name('admin.info-page.add');
    Route::get('/admin/info-page/edit/{info_page_id}', AdminEditInfoPageComponent::class)->name('admin.info-page.edit');
    Route::get('/admin/menu', AdminEditMenuComponent::class)->name('admin.menu.edit');
});

require __DIR__.'/auth.php';
