<div class="container">
    <div class="section text-center"><h1>Might Also Like</h1></div>
    <div class="row justify-content-center">
                @foreach ($mightAlsoLike as $product)
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
