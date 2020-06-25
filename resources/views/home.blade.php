@extends('layout')

@section('content')
        
    <div class="row">
        <h1>História em Quadrinhos</h1>
        <a href="{{ route('hq.create') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Criar HQ</button>
        </a>
    </div>
    <hr class="bg-dark"/>

@endsection