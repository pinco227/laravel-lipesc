@extends('layouts.app')

@section('extra-head')
<script src="{{ asset('js/landing-page.js') }}"></script>
@endsection

@section('content')
<div class="section featured-section">
    <h1>Featured</h1>
    <div class="container">
        <div class="row justify-content-center">
            @foreach ($products as $product)
            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                <div class="card">
                    <a href="{{ route('shop.show', $product->slug) }}"><img class="card-img" src="{{ $product->image }}"
                            alt="{{ $product->name }}"></a>
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
                        <!--
                                <div class="options d-flex flex-fill">
                                    <select class="custom-select mr-1">
                                        <option selected>Color</option>
                                        <option value="1">Green</option>
                                        <option value="2">Blue</option>
                                        <option value="3">Red</option>
                                    </select>
                                    <select class="custom-select ml-1">
                                        <option selected>Size</option>
                                        <option value="1">41</option>
                                        <option value="2">42</option>
                                        <option value="3">43</option>
                                    </select>
                                </div> -->
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
            @endforeach
        </div>
    </div>
</div>
<hr>
<div class="section featured-section">
    <h1>On Sale Now</h1>
    <div class="container">

        <div class="row justify-content-center">
            @foreach ($onSale as $product)
            <div class="col-12 col-sm-4 col-md-3 col-lg-2">
                <div class="card">
                    <a href="{{ route('shop.show', $product->slug) }}"><img class="card-img" src="{{ $product->image }}"
                            alt="{{ $product->name }}"></a>
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
                        <!--
                                <div class="options d-flex flex-fill">
                                    <select class="custom-select mr-1">
                                        <option selected>Color</option>
                                        <option value="1">Green</option>
                                        <option value="2">Blue</option>
                                        <option value="3">Red</option>
                                    </select>
                                    <select class="custom-select ml-1">
                                        <option selected>Size</option>
                                        <option value="1">41</option>
                                        <option value="2">42</option>
                                        <option value="3">43</option>
                                    </select>
                                </div> -->
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
            @endforeach
        </div>
    </div>
</div>
<hr>
<div class="container text-center button-container">
    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-block btn-lg">View more products...</a>
</div>
<hr>

</div> <!-- /container -->
<div class="section blog-section">
    <div class="container">
        <h1>From our Blog</h1>
        <p class="section-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna
            aliqua. Sit amet luctus venenatis lectus magna fringilla. Pellentesque nec nam aliquam sem et
            tortor. Et netus et
            malesuada fames ac.</p>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                <div class="card">
                    <img class="card-img-top" src="https://placeimg.com/300/300/arch" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's
                            content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                <div class="card">
                    <img class="card-img-top" src="https://placeimg.com/300/300/people" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's
                            content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-4 col-lg-3">
                <div class="card">
                    <img class="card-img-top" src="https://placeimg.com/300/300/tech" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's
                            content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
