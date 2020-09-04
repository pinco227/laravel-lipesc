@extends('layouts.app')

@section('extra-head')
<script src="{{ asset('js/jquery.card.js') }}"></script>
@endsection

@section('content')
<div class="container mb-4">
    <div class="section text-center">
        <h1>
            Checkout Form
        </h1><br />

    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <div class="card">
                <div class="card-header">
                    <h2 class="d-flex justify-content-between">
                        <span>Your cart</span>
                        <span class="badge badge-secondary badge-pill">{{ \Cart::getContent()->count() }}</span>
                    </h2>
                </div>
                <ul class="list-group list-group-flush mb-3">
                    @foreach($items as $item)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <a href=" {{ route('shop.show', $item->model->slug) }}">
                                <img class="img-thumbnail" src=" {{ asset($item->model->image) }}" width="50" />
                            </a>
                        </div>
                        <div>
                            <h6 class="my-0">
                                <a href=" {{ route('shop.show', $item->model->slug) }}">
                                    {{ $item->name }}
                                </a>
                            </h6>
                            @if ($item->details)
                            <small class="text-muted">{{ $item->details }}</small><br />
                            @endif
                            <small class="text-muted">Quantity: {{ $item->quantity }} *
                                {{ $item->model->presentPrice() }}</small>
                        </div>
                        <span class="text-muted">{{ presentPrice($item->getPriceSum()) }}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal</span>
                        <strong>{{ presentPrice(\Cart::getSubTotal()) }}</strong>
                    </li>
                    @foreach ($cartConditions as $cond)
                    <li class="list-group-item d-flex justify-content-between">
                        <span>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['coupon.delete', $cond->getName()],
                            'class' => 'form-inline']) !!}
                            {{ csrf_field() }}
                            {{ Form::button('<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-danger btn-sm'] )  }}
                            {!! Form::close() !!}
                        </span>
                        <span>{{ $cond->getName() }}</span>
                        <strong>
                            @if ($cond->getType()=='tax')
                            {{ $cond->getValue() }}
                            @else
                            {{ presentPrice($cond->getValue()) }}
                            @endif
                        </strong>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total</span>
                        <strong>{{ presentPrice(\Cart::GetTotal()) }}</strong>
                    </li>
                </ul>
            </div><br />

            {!! Form::open(['route' => 'coupon.store', 'class' => 'card p-2']) !!}
            {{ csrf_field() }}
            <div class="input-group">
                {!! Form::text('coupon_code', '', ['class'=>'form-control', 'placeholder'=>'Coupon code']) !!}
                <div class="input-group-append">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="col-md-8 order-md-1">
            {!! Form::open(['route' => 'checkout.pay', 'class'=>'form', 'method'=>'POST', 'id' => 'checkout-form']) !!}
            {{ csrf_field() }}
            <div class="card"> {{-- Address panel --}}
                <div class="card-header">
                    <h2>Address</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">* First name</label>
                            <input type="text" class="form-control" name="firstName" id="firstName" placeholder=""
                                value="{{ old('firstName') }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">* Last name</label>
                            <input type="text" class="form-control" name="lastName" id="lastName" placeholder=""
                                value="{{ old('lastName') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">* Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address">* Address</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St"
                            value="{{ old('address') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" name="address2" id="address2"
                            value="{{ old('address2') }}" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" name="country">
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" name="state">
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" value="{{ old('zip') }}" id="zip" name="zip"
                                placeholder="">
                        </div>
                    </div>
                </div>
            </div> {{-- end address panel --}}
            <br />
            <div class="card">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing
                        address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
            </div>
            <br />
            <div class="card"> {{-- payment panel --}}
                <div class="card-header">
                    <h2>Payment</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="username">Full name (on the card)</label>
                                <input type="text" name="cc-name" id="cc-name" placeholder="Jason Doe" required
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cardNumber">Card number</label>
                                <input type="text" name="cc-number" id="cc-number" placeholder="Your card number"
                                    class="form-control" required>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label><span class="hidden-xs">Expiration</span></label>
                                        <div class="input-group">
                                            <input type="number" placeholder="MM" name="cc-ExpiryMonth"
                                                id="cc-ExpiryMonth" class="form-control" required>
                                            <input type="number" placeholder="YYYY" name="cc-ExpiryYear"
                                                id="cc-ExpiryYear" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label data-toggle="tooltip"
                                            title="Three-digits code on the back of your card">CVV
                                            <i class="fa fa-question-circle"></i>
                                        </label>
                                        <input type="text" name="cc-cvc" id="cc-cvc" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 card-wrapper">

                        </div>
                    </div>
                </div>
            </div> {{-- end payment panel --}}
            {!! Form::hidden('cart-id', '123') !!}
            <br />
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="submit-checkout">Confirm & Pay</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include('partials.might-like')
@endsection

@section('extra-footer')
<script>
    $('#checkout-form').card({
        container: '.card-wrapper',
        numberInput: 'input#cc-number',
        expiryInput: 'input#cc-ExpiryMonth, input#cc-ExpiryYear',
        cvcInput: 'input#cc-cvc',
        nameInput: 'input#cc-name',
    });
</script>
@endsection
