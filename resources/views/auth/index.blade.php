@extends('layouts.app')

@section('content')
    <div class="row">
        <h1>
            Usuário - {{ $usuario->name }}
            <a href="{{ route('hq.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
        
    </div>
    <hr class="bg-dark mt-0"/>

@endsection