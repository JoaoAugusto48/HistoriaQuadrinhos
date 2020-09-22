@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Balão
            <a href="{{ route('gerencia.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-reply"></i> Gerência
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

@endsection