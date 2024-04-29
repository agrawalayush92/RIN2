@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('users') }}" class="button">Check users List</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.button {
    display: inline-block;
    padding: 10px 20px;
    font-size: 20px;
    text-align: center;
    cursor: pointer;
    outline: none;
    color: #fff;
    background-color: #4CAF50;
    border: none;
    border-radius: 5px;
    text-decoration: none;
}

.button:hover {background-color: #3e8e41}

.button:active {
    background-color: #3e8e41;
    box-shadow: 0 5px #666;
    transform: translateY(4px);
}
</style>

@endsection
