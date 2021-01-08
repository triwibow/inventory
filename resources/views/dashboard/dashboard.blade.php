@extends('layout/main')

@section('title', 'Home')

@section('container')

    <div class="page-title">
        <h1>Home</h1>
    </div>
    <div class="container">
       <h1>Welcome, {{$username}}</h1>
    </div>

@endsection

