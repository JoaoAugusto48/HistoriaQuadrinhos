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
                <input id="txt-titulo" type="text" class="form-control" name="tema" maxlength="100" required autofocus>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Local:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="local" maxlength="70" required>
            </div>
        </div>

        <!-- Button trigger modal personagem 1 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 1:</label>
            <div class="col-sm-8">
                <button id="btn-personagem1" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem1">
                    Personagem 1
                </button>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Saudação 1:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao1" maxlength="70" placeholder="ex: Oi, sou gerente administrativo." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 1." required>
            </div>
        </div>
        
        <!-- Button trigger modal personagem 2 -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Personagem 2:</label>
            <div class="col-sm-8">
                <button id="btn-personagem2" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#personagem2">
                    Personagem 2
                </button>
            </div>
        </div>

        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Saudação 2:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="saudacao2" maxlength="70" placeholder="ex: Olá, sou especialista em negócios." autocomplete="off" data-toggle="tooltip" data-placement="top" title="Faça uma saudação com Personagem 2." required>
            </div>
        </div>

        <!-- Button trigger modal ambiente -->
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right">Ambiente:</label>
            <div class="col-sm-8">
                <button id="btn-ambiente" type="button" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#ambiente">
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
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarP1()">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($personagems as $personagem)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $personagem->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $personagem->id }}" name="personagem1_id" value="{{ $personagem->id }}" data-descricao="{{ $personagem->descricao }}" data-img="{{ $personagem->personagem }}" onclick="checked_radio()">
                                            <img src="{{ env('APP_URL') }}/storage/{{ $personagem->personagem }}" class="card-img-top">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarP1()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 1 -->

<!-- Javascript de Confirmação de seleção personagem 1 -->
<script>
    // let titulo = document.querySelector("#txt-titulo");
    // let personagem1 = document.querySelector("#btn-personagem1");

    // titulo.addEventListener("input",function(){
    //     console.log(this.value);
    //     personagem1.textContent = this.value;
    // })

    function  confirmarP1() {
        let personagem1 = document.querySelector("#btn-personagem1");
        let radio_personagem1 = document.getElementsByName("personagem1_id");

        for (let i = 0; i < radio_personagem1.length; i++) {
            const el = radio_personagem1[i];
            if(el.checked){
                // console.log(el);
                let personagem = el.getAttribute("data-descricao");
                personagem1.textContent = "Personagem Selecionado: " + personagem;
                let img = el.getAttribute("data-img");

                let imagem = document.createElement("img");
                imagem.src = "{{ env('APP_URL') }}/storage/" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                personagem1.appendChild(imagem);
            }
            
        }

        // console.log(radio_personagem1);
    }

</script>
<!-- Fim javascript de confirmação de seleção personagem 1 -->

<!-- Modal Personagem 2 -->
<div class="modal fade" id="personagem2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 2</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarP2()">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($personagems as $personagem)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $personagem->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $personagem->id }}" name="personagem2_id" value="{{ $personagem->id }}" data-descricao="{{ $personagem->descricao }}" data-img="{{ $personagem->personagem }}" onclick="checked_radio()">
                                            <img src="{{ env('APP_URL') }}/storage/{{ $personagem->personagem }}" class="card-img-top">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarP2()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 2 -->

<!-- Javascript de Confirmação de seleção personagem 2 -->
<script>

    function confirmarP2(){
        let personagem2 = document.querySelector("#btn-personagem2");
        let radio_personagem2 = document.getElementsByName("personagem2_id");

        for (let i = 0; i < radio_personagem2.length; i++) {
            const el = radio_personagem2[i];
            if(el.checked){
                // console.log(el);
                let personagem = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                personagem2.textContent = "Personagem Selecionado: " + personagem;

                let imagem = document.createElement("img");
                imagem.src = "{{ env('APP_URL') }}/storage/" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                personagem2.appendChild(imagem);
            }
            
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção personagem 2 -->

<!-- Modal Ambiente -->
<div class="modal fade" id="ambiente" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ambiente</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarAmbiente()">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($ambientes as $ambiente)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $ambiente->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $ambiente->id }}" name="ambiente_id" value="{{ $ambiente->id }}" data-descricao="{{ $ambiente->descricao }}" data-img="{{ $ambiente->fundo }}" onclick="checked_radio()">
                                            <img src="{{ env('APP_URL') }}/storage/{{ $ambiente->fundo }}" class="card-img-top">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarAmbiente()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Ambiente -->

<!-- Javascript de Confirmação de seleção ambiente -->
<script>

    function confirmarAmbiente(){
        let ambiente = document.querySelector("#btn-ambiente");
        let radio_ambiente = document.getElementsByName("ambiente_id");

        for (let i = 0; i < radio_ambiente.length; i++) {
            const el = radio_ambiente[i];
            if(el.checked){
                // console.log(el);
                let descricao = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                ambiente.textContent = "Ambiente Selecionado: " + descricao;

                let imagem = document.createElement("img");
                imagem.src = "{{ env('APP_URL') }}/storage/" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                ambiente.appendChild(imagem);
            }
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção ambiente -->

    </form>

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
