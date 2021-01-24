@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Gerência
            <a href="{{ route('software.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <div class="row mb-2">
        <h3>Personagens e Fundo</h3>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card border border-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Personagens</h5>
                    <p class="card-text">Gerenciar os personagens disponíveis a criação de HQs.</p>
                    <a href="{{ route('personagem.index') }}" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card border border-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Ambientes</h5>
                    <p class="card-text">Gerenciar os ambientes disponíveis a criação de HQs.</p>
                    <a href="{{ route('ambiente.index') }}" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2 mb-2">
        <h3>Objetos</h3>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="card border border-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Balões</h5>
                    <p class="card-text">Adicionar ou remover os balões de fala disponíveis.</p>
                    <a href="{{ route('balao.index') }}" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card border border-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Utensilios</h5>
                    <p class="card-text">Adicionar ou remover os objetos disponíveis a HQ.</p>
                    <a href="{{ route('utensilio.index') }}" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card border border-dark shadow">
                <div class="card-body">
                    <h5 class="card-title">Quadrinho Personagens</h5>
                    <p class="card-text">Gerenciar balões que estão vinculados ao quadrinho de personagens.</p>
                    <a href="{{ route('quadrinhoPersonagem.index') }}" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        </div>
    </div>


@endsection