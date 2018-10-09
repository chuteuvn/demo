@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 bg-primary">
            <ul class="list-group">
                <li class="list-group-item"><a href="{{ route('home') }}">Dashboard</a></li>
                <li class="list-group-item"><a href="{{ route('product.import') }}">Product</a></li>
            </ul>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
