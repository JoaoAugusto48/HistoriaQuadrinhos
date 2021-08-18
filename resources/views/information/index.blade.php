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
    <hr class="bg-dark mt-0" />

    <div class="container">
        <div class="form-group">
            <div class="row">
                <h3 class="col-sm-12 p-0">Clientes</h3>

                <div class="col-sm-4 form-group">
                    <label>Parcerias:</label>
                    <input type="text" class="form-control" value="{{ $nParceiros }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Em Contrato:</label>
                    <input type="text" class="form-control" value="{{ $nEmContrato }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Mais Projetos:</label>
                    <input type="text" class="form-control" value="{{ $maisProjeto }}" disabled>
                </div>
            </div>
            <div class="row mt-3">
                <h3 class="col-sm-12 p-0">Software</h3>

                <div class="col-sm-4 form-group">
                    <label>Total:</label>
                    <input type="text" class="form-control" value="{{ $nSoftwares }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Em Atividade:</label>
                    <input type="text" class="form-control" value="{{ $hqAtuais }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Com mais HQs:</label>
                    <input type="text" class="form-control" value="{{ $nParceiros }}" disabled>
                </div>
            </div>
            <div class="row mt-3">
                <h3 class="col-sm-12 p-0">Histórias em Quadrinhos</h3>

                <div class="col-sm-4 form-group">
                    <label>Total HQs:</label>
                    <input type="text" class="form-control" value="{{ $nSoftwares }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Total atual:</label>
                    <input type="text" class="form-control" value="{{ $hqAtuais }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Com mais Quadrinhos:</label>
                    <input type="text" class="form-control" value="{{ $nParceiros }}" disabled>
                </div>
            </div>
            <div class="row mt-3">
                <h3 class="col-sm-12 p-0">Quadrinhos</h3>

                <div class="col-sm-4 form-group">
                    <label>Mais páginas:</label>
                    <input type="text" class="form-control" value="{{ $nSoftwares }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Ambiente mais usado:</label>
                    <input type="text" class="form-control" value="{{ $hqAtuais }}" disabled>
                </div>
                <div class="col-sm-4 form-group">
                    <label>Total:</label>
                    <input type="text" class="form-control" value="{{ $hqAtuais }}" disabled>
                </div>
            </div>
        </div>
    </div>

    {{-- <form>
        <div class="form-group row">
            <h3 class="col-sm-12">Clientes - {{ $nClientes }}</h3>

            <label class="col-sm-2 col-form-label text-right font-weight-bold">
                Empresas: {{ $nEmpresas }}
            </label>
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
    </form> --}}

@endsection
