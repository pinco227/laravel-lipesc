@extends('layouts.app')

@section('content')
<div class="container mb-4">
    <div class="jumbotron text-center">
        <div class="section text-center">
            <h1>
                Thank You!
            </h1>
        </div>
        <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your
            account
            setup.</p>
        <hr>
        <p>
            Having trouble? <a href="">Contact us</a>
        </p>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="{{ route('landing-page') }}" role="button">Continue to
                homepage</a>
        </p>
    </div>
</div>
@include('partials.might-like')
@endsection
