@extends('layouts.app')

@section('content')

    <div class="row">
        <h1>
            Informações
            <a href="{{ route('software.index') }}" class="btn btn-outline-dark ml-1" target="_parent">
                <i class="fas fa-home"></i> Inicio
            </a>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <form>
        <div class="form-group row">
            <h3 class="col-sm-12">Clientes - {{ $nClientes }}</h3>

            <label class="col-sm-2 col-form-label text-right font-weight-bold">
                Empresas: {{ $nEmpresas }}
            </label>
        </div>

        <div class="form-group row">
            <h3 class="col-sm-12">Softwares - {{ $nSoftwares }}</h3>

            <label class="col-sm-2 col-form-label text-right font-weight-bold" title="Histórias em Quadrinhos">
                HQs: {{ $nEmpresas }}
            </label>
        </div>
    </form>

@endsection
