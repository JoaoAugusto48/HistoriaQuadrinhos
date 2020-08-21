@extends('layouts.app')

@section('content')
        
    <div class="row">
        <h1>
            Criar HQ
            <button class="btn btn-outline-dark ml-1" onclick="javascript:history.back()"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
        </h1>
    </div>
    <hr class="bg-dark mt-0"/>

    <form action="{{ route('hq.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Titulo:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="tema" maxlength="100" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Local:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="local" maxlength="70" required>
            </div>
        </div>

        <!-- Button trigger modal personagem 1 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Personagem 1:</label>
            <div class="col-sm-8">
                <button id="btn-personagem1" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem1">
                    Personagem 1
                </button>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Saudação 1:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao1" maxlength="70" placeholder="ex: Oi, sou gerente administrativo." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 1." required>
            </div>
        </div>
        
        <!-- Button trigger modal personagem 2 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Personagem 2:</label>
            <div class="col-sm-8">
                <button id="btn-personagem2" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem2">
                    Personagem 2
                </button>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Saudação 2:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao2" maxlength="70" placeholder="ex: Olá, sou especialista em negócios." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 2." required>
            </div>
        </div>

        <!-- Button trigger modal ambiente -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Ambiente:</label>
            <div class="col-sm-8">
                <button id="btn-ambiente" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#ambiente">
                    Ambiente
                </button>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary font-weight-bold">Enviar</button>
        </div>

        {{-- Incluindo os modais responsáveis pela apesentação dos dados selecionaveis pelo usuário --}}
        @include('hq.modal.personagem1')
        @include('hq.modal.personagem2')
        @include('hq.modal.ambiente')
        

    </form>

{{-- função Javascrit para selecionar opção presente nos modais --}}
<script>
    function checked_radio() {
        let radioButtons = document.querySelectorAll("input[type='radio']");

        for (let i = 0; i < radioButtons.length; i++) {
            const el = radioButtons[i];

            if (el.checked) {
                el.closest(".card").classList.add("card-checked");
            } else {
                el.closest(".card").classList.remove("card-checked");
            }      
        }
    }
</script>

@endsection
