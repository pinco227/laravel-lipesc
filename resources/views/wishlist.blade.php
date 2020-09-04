@extends('layouts.app')

@section('extra-head')
<script src="{{ asset('js/cart.js') }}"></script>
@endsection

@section('content')
<div class="container mb-4">
    <div class="section text-center">
        <h1>
            Your Wishlist
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
                            <th>
                                Quantity
                            </th>
                            <th class="text-right" scope="col">
                                Price
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
                                {!! Form::open(['method' => 'POST', 'route' => ['wishlist.moveToCart', $item->id],
                                'class' =>
                                'form-inline']) !!}
                                {{ csrf_field() }}
                                {{ Form::button('<i class="fa fa-shopping-cart"></i> Move to Cart', ['type' => 'submit', 'class' => 'btn btn-success btn-sm'] )  }}
                                {!! Form::close() !!}
                            </td>
                            <td>
                                {!! Form::open(['method' => 'PUT', 'route' => ['wishlist.update', $item->id], 'class' =>
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
                                {!! Form::open(['method' => 'DELETE', 'route' => ['wishlist.delete', $item->id], 'class'
                                =>
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
                                {{ presentPrice(app('wishlist')->getSubTotal()) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">
                                <strong>
                                    Total
                                </strong>
                            </td>
                            <td colspan="2">
                                <strong>
                                    {{ presentPrice(app('wishlist')->GetTotal()) }}
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col mb-2">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <a href="{{ route('shop.index') }}" class="btn btn-lg btn-block btn-outline-secondary">
                        Continue Shopping
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="alert alert-danger text-center" role="alert">
                <strong>
                    No Items in WishList!
                </strong>
            </div>
        </div>
        @endif
    </div>
</div>
@include('partials.might-like')
@endsection
