@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories
                </div>
                <div class="list-group list-group-flush category_block">
                    @foreach ($categories as $category)
                    <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ setActiveCategory($category->slug, 'list-group-item-info active') }}"
                        href="{{ route('shop.index', ['category' => $category->slug]) }}">
                        {{ $category->name }}
                        <span class="badge badge-light badge-pill">14</span>
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Last product</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <p class="bloc_left_price">99.00 $</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="section">
                <div class="products-header">
                    <h1>{{ $categoryName }}</h1>
                    <div>
                        <strong>Price</strong>
                        <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'low_high']) }}">Low
                            to High</a> |
                        <a href="{{ route('shop.index', ['category' => request()->category, 'sort' => 'high_low']) }}">High
                            to Low</a>
                    </div>
                </div><br />
            </div>
            <div class="row justify-content-center">
                {{ $products->appends(request()->input())->links() }}
            </div>
            <br />
            <div class="row justify-content-center">
                @forelse ($products as $product)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <div class="card">
                        <a href="{{ route('shop.show', $product->slug) }}"><img class="card-img"
                                src="{{ $product->image }}" alt="{{ $product->name }}"></a>
                        <!--<div class="card-img-overlay d-flex justify-content-end">
                                                            <a href="#" class="card-link text-danger like">
                                                                <i class="fas fa-heart"></i>
                                                            </a>
                                                        </div>-->
                        <div class="card-body">
                            <h4 class="card-title"><a
                                    href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a></h4>
                            <h6 class="card-subtitle mb-2 text-muted">Details: {{ $product->details }}
                            </h6>
                            <p class="card-text">
                                {{ $product->details }} </p>
                            <div class="buy d-flex justify-content-between align-items-center">
                                <div class="price text-success">
                                    <h5 class="mt-4">{{ $product->presentPrice() }}</h5>
                                </div>
                                <a href="#" class="btn btn-danger mt-3"><i class="fas fa-shopping-cart"></i> Add to
                                    Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-warning" role="alert">
                    <strong>No items found.</strong>
                </div>
                @endforelse
            </div>
            <br />
            <div class="row justify-content-center">
                {{ $products->appends(request()->input())->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
