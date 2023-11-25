<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('home.index') }}" rel="nofollow">Home</a>
                    <span></span> Category
                    <span></span> {{ $category_name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you from <strong class="text-brand">{{ $category_name }}</strong> category!</p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Show:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $pageSize }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $pageSize == 10 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(10)">10</a></li>
                                            <li><a class="{{ $pageSize == 20 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(20)">20</a></li>
                                            <li><a class="{{ $pageSize == 50 ? 'active' : '' }}" href="#" wire:click.prevent="changePageSize(50)">50</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $sortingType }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $sortingType == 'Featured' ? 'active' : '' }}" href="#" wire:click.prevent="changeSortingType('Featured')">Featured</a></li>
                                            <li><a class="{{ $sortingType == 'Price: Low to High' ? 'active' : '' }}" href="#" wire:click.prevent="changeSortingType('Price: Low to High')">Price: Low to High</a></li>
                                            <li><a class="{{ $sortingType == 'Price: High to Low' ? 'active' : '' }}" href="#" wire:click.prevent="changeSortingType('Price: High to Low')">Price: High to Low</a></li>
                                            <li><a class="{{ $sortingType == 'Release Date' ? 'active' : '' }}" href="#" wire:click.prevent="changeSortingType('Release Date')">Release Date</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @foreach($products as $product)

                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product.details', ['slug' => $product->slug]) }}">
                                                    <img class="default-img" src="{{ asset('assets/imgs/products') }}/{{ $product->id }}/{{ scandir(public_path('assets/imgs/products/' . $product->id))[2] }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('category.details', ['slug' => $product->category->slug]) }}">{{ $product->category->name }}</a>
                                            </div>
                                            <h2><a href="{{ route('product.details', ['slug' => $product->slug]) }}">{{ $product->name }}</a></h2>
                                            <div class="product-price">
                                                <span>$ {{ $product->price }} </span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="#" wire:click.prevent="store({{ $product->id }},'{{ $product->name }}',{{ $product->price }})"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{ $products->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @foreach($categories as $category)
                                    <li><a class="{{ str_contains(Request::url(), $category->slug) ? 'active' : '' }}" href="{{ route('category.details', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
