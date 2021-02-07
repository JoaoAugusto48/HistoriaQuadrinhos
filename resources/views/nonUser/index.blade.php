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
                    <h5 class="card-title">Crie suas próprias Histórias</h5>
                    <hr class="m-0 mb-2">
                    <p class="card-text">No intuito de auxiliar no desenvolvimento de softwares, {{ config('app.name') }} visa auxiliar a stakeholders na especificação do software.</p>
                    <a href="{{ route('register') }}" class="btn btn-primary">Faça já seu cadastro!</a>
                </div>
            </div>
        </div>
    </div>

@endsection
