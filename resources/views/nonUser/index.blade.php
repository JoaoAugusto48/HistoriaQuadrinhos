@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-sm-6 d-flex align-items-center">
            <p class="h5 text-justify">
                {{ config('app.name') }} é uma plataforma para auxiliar desenvolvedores com a especificação de requisitos de software.
            </p>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    </div>

@endsection