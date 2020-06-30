@extends('layout')

@section('content')
        
    <div class="row">
        <h1>Criar História em Quadrinho</h1>
        <a href="{{ route('hq.store') }}" target="_parent">
            <button class="btn btn-outline-dark ml-3">Inicio</button>
        </a>
    </div>
    <hr class="bg-dark"/>

    <form action="{{ route('hq.store') }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Titulo:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="tema" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Local:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="local" required>
            </div>
        </div>

        <!-- Button trigger modal personagem 1 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 1:</label>
            <div class="col-sm-8">
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem1">
                    Personagem 1 <!-- <span class="btnPersonagem1"></span> -->
                </button>
            </div>
        </div>

        <!-- Button trigger modal personagem 2 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 2:</label>
            <div class="col-sm-8">
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem2">
                    Personagem 2
                </button>
            </div>
        </div>

        <!-- Button trigger modal ambiente -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Ambiente:</label>
            <div class="col-sm-8">
                <button type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#ambiente">
                    Ambiente
                </button>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 pl-1 text-left">
            <button type="submit" class="btn btn-outline-primary">Enviar</button>
        </div>

        
<!-- Modal Personagem 1 -->
<div class="modal fade" id="personagem1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 1</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    @foreach ($personagems as $personagem)
                    <div class="col-md-4">
                        <input type="radio" id="{{ $personagem->id }}" name="personagem1_id" value="{{ $personagem->id }}">
                        <label for="{{ $personagem->id }}">
                            <div class="card-group">
                                <div class="card" style="width: 12rem;">
                                    <img src="{{ env('APP_URL') }}/storage/{{ $personagem->personagem }}" class="card-img-top">
                                    <div class="card-footer text-muted">
                                        <h5 class="card-title">{{ $personagem->descricao }}</h5>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 1 -->

<!-- Javascript de Confirmação de seleção personagem 1 -->
{{-- <script>
    const btn = document.querySelector('#btnPersonagem1');
    // handle click button
    btn.onclick = function () {
        const rbs = document.querySelectorAll('radio[name="personagem_id"]');
        let selectedValue;
        for (const rb of rbs) {
            if (rb.checked) {
                selectedValue = rb.value;
                break;
            }
        }
        alert(selectedValue);
    };
</script> --}}
<!-- Fim javascript de confirmação de seleção personagem 1 -->

<!-- Modal Personagem 2 -->
<div class="modal fade" id="personagem2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 2</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    @foreach ($personagems as $personagem)
                    <div class="col-md-4">
                        <input type="radio" id="{{ $personagem->id }}" name="personagem2_id" value="{{ $personagem->id }}">
                        <label for="{{ $personagem->id }}">
                            <div class="card-group">
                                <div class="card" style="width: 12rem;">
                                    <img src="{{ env('APP_URL') }}/storage/{{ $personagem->personagem }}" class="card-img-top">
                                    <div class="card-footer text-muted">
                                        <h5 class="card-title">{{ $personagem->descricao }}</h5>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 2 -->

<!-- Modal Ambiente -->
<div class="modal fade" id="ambiente" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 2</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    @foreach ($ambientes as $ambiente)
                    <div class="col-md-4">
                        <input type="radio" id="{{ $ambiente->id }}" name="ambiente_id" value="{{ $ambiente->id }}">
                        <label for="{{ $ambiente->id }}">
                            <div class="card-group">
                                <div class="card" style="width: 12rem;">
                                    <img src="{{ env('APP_URL') }}/storage/{{ $ambiente->fundo }}" class="card-img-top">
                                    <div class="card-footer text-muted">
                                        <h5 class="card-title">{{ $ambiente->descricao }}</h5>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Ambiente -->
    </form>

@endsection
