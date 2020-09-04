@extends('layouts.app')

@section('extra-head')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection

@section('content')
<div class="container mb-4">
    <div class="section text-center">
        <h1>
            Your Shopping Cart
        </h1>
    </div>
    <div class="row">
        @if ($items->count()>0)
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">
                            </th>
                            <th scope="col">
                                Product
                            </th>
                            <th class="text-center w-25" scope="col">
                                Quantity
                            </th>
                            <th class="text-right" scope="col">
                                Price
                            </th>
                            <th class="text-right" scope="col">
                                Subtotal
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr>
                            <td>
                                <a href=" {{ route('shop.show', $item->model->slug) }}">
                                    <img class="img-thumbnail" src=" {{ asset($item->model->image) }}" width="100" />
                                </a>
                            </td>
                            <td>
                                <a href=" {{ route('shop.show', $item->model->slug) }}">
                                    {{ $item->name }}
                                </a>
                                <br />
                                {{ $item->model->details }}
                                <br />
                                {!! Form::open(['method' => 'POST', 'route' => ['cart.moveToWishList', $item->id],
                                'class' =>
                                'form-inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::button('<i class="fa fa-heart"></i> Move to Wishlist
                                                    ', ['type' => 'submit', 'class' => 'btn btn-success btn-sm'] )  }}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'PUT', 'route' => ['cart.update', $item->id], 'class' =>
                                'form-inline']) !!}
                                {{ csrf_field() }}
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group number-spinner">
                                        <span class="input-group-btn data-dwn">
                                            <button class="btn btn-outline-secondary" data-dir="dwn"><i
                                                    class="fa fa-minus"></i></button>
                                        </span>
                                        {{ Form::number('quantity', $item->quantity, ['class' => 'form-control', 'id' => 'quantity', 'min' => '1', 'max' => '100']) }}
                                        <span class="input-group-btn data-up">
                                            <button class="btn btn-outline-secondary" data-dir="up"><i
                                                    class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
                                    <div class="input-group-append">
                                        {{-- {{ Form::button('<i class="fa fa-sync"></i>', ['type' => 'submit', 'class' => 'btn btn-outline-info'] )  }}
                                        --}}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </td>
                            <td class="text-right">
                                {{ $item->model->presentPrice() }}
                            </td>
                            <td class="text-right">
                                {{ presentPrice($item->getPriceSum()) }}
                            </td>
                            <td class="text-right">
                                {!! Form::open(['method' => 'DELETE', 'route' => ['cart.delete', $item->id], 'class' =>
                                'form-inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::button('
                    <i class="fa fa-trash">
                    </i>
                    ', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">
                                Sub-Total
                            </td>
                            <td colspan="2">
                                {{ presentPrice(\Cart::getSubTotal()) }}
                            </td>
                        </tr>
                        @foreach ($cartConditions as $cond)
                        <tr>
                            <td colspan="4" class="text-right">
                                {{ $cond->getName() }}
                            </td>
                            <td colspan="2">
                                @if ($cond->getType()=='tax')
                                {{ $cond->getValue() }}
                                @else
                                {{ presentPrice($cond->getValue()) }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-right">
                                <strong>
                                    Total
                                </strong>
                            </td>
                            <td colspan="2">
                                <strong>
                                    {{ presentPrice(\Cart::GetTotal()) }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <a href="{{ route('shop.index') }}" class="btn btn-lg btn-block btn-outline-secondary">
                        Continue Shopping
                    </a>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <a class="btn btn-lg btn-block btn-success text-uppercase" href="{{ route('checkout.index') }}">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-danger text-center" role="alert">
                <strong>
                    No Items in Cart!
                </strong>
            </div>
        </div>
        @endif
    </div>
</div>
@include('partials.might-like')
@endsection
