@extends('layouts.app')

@section('js')
    <script src="{{ asset('js/quadrinho/gerarQuadrinho.js') }}"></script>
@endsection

@section('content')

    <script>
        window.addEventListener("scroll", (event) => {
            let scroll = this.scrollY;
        });

    </script>

    <div class="container pt-1">
        <div class="row">
            <h1>Criar - {{ $hq->tema }}, pág. {{ $quadrinho->pagina }}</h1>
        </div>
        <a class="btn btn-outline-dark" href="{{ route('hq.show', $hq->id) }}">
            <i class="fa fa-reply" aria-hidden="true"></i> Voltar
        </a>
        <button class="btn btn-outline-dark ml-2" onclick="javascript:location.reload()">
            <i class="fa fa-undo" aria-hidden="true"></i> Recarregar
        </button>
    </div>
    <hr class="bg-dark" />


    <div class="p-3">

        <div class="form-group row">
            <label for="nome" class="col-sm-12 col-form-label text-center"><span
                    class="font-weight-bold">{{ $faseQuadrinho['fase'] }}</span> -
                {{ $faseQuadrinho['mensagem'] }}</label>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Fala do autor:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="titulo" maxlength="255"
                    value="{{ $quadrinho->titulo }}" placeholder="Se o autor houver fala. Adicione-a aqui.">
            </div>
        </div>

        <h3 class="text-center">Arraste os itens abaixo!</h3>

        @include('quadrinhos.cardStatus')

        <div class="container">
            <div class="btn-group w-100 mb-0">
                <button id="btn-balao" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#balao">
                    Balão de fala
                </button>
                <button id="btn-utensilio" type="button" class="btn btn-secondary" data-toggle="modal"
                    data-target="#utensilio">
                    Objetos
                </button>
                <button id="btn-personagem" type="button" class="btn btn-secondary" data-toggle="modal"
                    data-target="#personagem">
                    Personagens
                </button>
            </div>
            @php
                // para verificar se imagem repete ou não
                $repeteX = $hq->ambiente->repeteFundo ? 'background-repeat: repeat-x' : '';
            @endphp
            <div class="container containerCustomizado" id="fundo"
                style="background-color: white; background-image: url('{{ $caminho_imagem . $hq->ambiente->fundo }}'); {{ $repeteX }}">
                <div class="row">
                    <div class="col-12">
                        <div class="col-9 acopla-imagens" id="acopla-imagens"
                            style="display: flex; align-items: stretch; z-index:2">
                            {{-- <div id="personagem1" class="arrastavel personagem personagem1" ondblclick="espelharImagem(event)" oncontextmenu="mostraBotoes(event)" style="z-index: 101; background-image: url('{{ $caminho_imagem.$hq->personagem1->personagem }}')">
                                <button id="btnRotate" type="button" class="btn btn-dark operacoesPersonagem" style="display: none"><i class="fas fa-adjust"></i></button>
                            </div> --}}
                            <div id="personagemImg" class="arrastavel personagem personagem1"
                                style="z-index: 101; background-image: url('{{ $caminho_imagem . $hq->personagem1->personagem }}')">
                                <button type="button" class="btn btn-dark operacoesPersonagem" style="display: none"><i
                                        class="fas fa-adjust"></i></button>
                            </div>
                            <div id="personagemImg" class="arrastavel personagem personagem2"
                                ondblclick="espelharImagem(event)"
                                style="z-index: 100; background-image: url('{{ $caminho_imagem . $hq->personagem2->personagem }}')">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container" id="semEstilo">
            <div class="row">
                <div class="col-12 mb-3">
                    <button class="btn btn-success"
                        onclick="baixaQuadrinho({{ $hq->id }}, {{ $quadrinho->id }})" id="baixar"><i class="fa fa-eye"
                            aria-hidden="true"></i> Visualizar Quadrinho</button>
                </div>
            </div>
        </div>

        <div class="container" id="semEstilo">
            <div class="row">
                <div class="col-12">
                    <form action="{{ route('quadrinho.update', $quadrinho->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div id="output-quadrinho"></div>
                        <div id="titulo-escondido"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('quadrinhos.modal.balaoFala')
    @include('quadrinhos.modal.utensilio')
    @include('quadrinhos.modal.personagem')
    @include('javascript.modal.selecionarItem')

    <script>
        let personagem = $("div[id^=personagemImg]").length;
        let balao = $("div[id^=balaoMsg]").length;
        let utensilio = $("div[id^=utensilioImg]").length;
        let fundo = $("div[id^=fundo]").length;

        // utensilio += fundo;
        console.log("Personagem: " + personagem);
        console.log("Balão: " + balao);
        console.log("Utensilio: " + utensilio);

        document.getElementById("personagem").addEventListener("click", function(e) {
            personagem = $("div[id^=personagemImg]").length;
            console.log("Personagem: " + personagem);
        });
        // document.getElementById("personagemImg").addEventListener("contextmenu",function(e) {
        //     personagem = $("div[id^=personagemImg]").length;
        //     console.log(personagem);
        // });

        document.getElementById("balao").addEventListener("click", function(e) {
            balao = $("div[id^=balaoMsg]").length;
            console.log("Balão: " + balao);
        });

        document.getElementById("utensilio").addEventListener("click", function(e) {
            utensilio = $("div[id^=utensilioImg]").length;
            // utensilio += fundo;
            console.log("Utensilio: " + utensilio);
        });



        function reconheceObjetos() {
            adicionaEventListeners();
            let objetosQuadrinho = document.getElementsByClassName('arrastavel');
            let retorno = []; //analise de todos os objetos na tela
            /*
                tipoObjeto
                1 = personagem
                2 = objeto
                3 = balao de fala
            */

            for (let i = 0; i < objetosQuadrinho.length; i++) {
                let objeto = {
                    posicaoCima: 0,
                    posicaoBaixo: 0,
                    posicaoDireita: 0,
                    posicaoEsquerda: 0,
                    posicaoX: 0,
                    posicaoY: 0,
                    imagemUrl: '',
                    larguraProprioObjeto: 0,
                    alturaProprioObjeto: 0,
                    tipoObjeto: 0
                }

                let bounding = objetosQuadrinho[i].getBoundingClientRect();

                objeto.posicaoCima = parseInt(bounding.top);
                objeto.posicaoBaixo = parseInt(bounding.bottom);
                objeto.posicaoDireita = parseInt(bounding.right);
                objeto.posicaoEsquerda = parseInt(bounding.left);
                objeto.posicaoX = parseInt(bounding.x);
                objeto.posicaoY = parseInt(bounding.y);
                objeto.larguraProprioObjeto = objetosQuadrinho[i].offsetWidth;
                objeto.alturaProprioObjeto = objetosQuadrinho[i].offsetHeight;
                objeto.imagemUrl = objetosQuadrinho[i].style.backgroundImage;

                if (objetosQuadrinho[i].id == 'personagemImg') {
                    objeto.tipoObjeto = 1;
                }

                if (objetosQuadrinho[i].id == 'utensilioImg') {
                    objeto.tipoObjeto = 2;
                }

                if (objetosQuadrinho[i].id == 'balaoMsg') {
                    objeto.tipoObjeto = 3;
                }

                retorno.push(objeto);

            }
            
            mensagemRetorno();

            console.log(retorno);
        }

        //deve ser chamada na criação do objeto e ao inicializar a página
        function adicionaEventListeners() {

            let objetosQuadrinho = document.getElementsByClassName('arrastavel');

            for (let i = 0; i < objetosQuadrinho.length; i++) {
                // objetosQuadrinho[i].removeEventListener('blur', function(){}, false);
                objetosQuadrinho[i].addEventListener('click', reconheceObjetos);
            }

            // evento para verificar texto do narrador
            let narrador = document.getElementById('txt-titulo');
            narrador.addEventListener('input', function(){
                let textoNarrador = false;
                if(narrador.value.length > 0){
                    textoNarrador = true;
                }
                // console.log(textoNarrador);
            });
            
        }

        adicionaEventListeners();
        // setInterval(function(){ reconheceObjetos() }, 3000);
        
        function mensagemRetorno(){
            // para retornar a mensagem ao usuário

            // para mostrar a mensagem
            let mensagem = document.getElementById("resposta");
            mensagem.innerHTML = null;
            let texto = document.createElement("p");
            texto.classList.add("card-text");
            texto.classList.add("m-0");
            texto.classList.add("text-success");
            console.log(mensagem);
            mensagem.appendChild(texto);
            texto.innerHTML = "Isso é um teste de Sucesso";

            // para não permitir o uso do botão
            if(personagem > utensilio){
                let baixarQuadrinho = document.getElementById("baixar");
                baixarQuadrinho.disabled = true;
            }
        }
    </script>


@endsection
