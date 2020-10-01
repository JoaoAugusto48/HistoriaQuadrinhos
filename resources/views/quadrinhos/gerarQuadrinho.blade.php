@extends('layouts.app')

@section('content')

<script>
    window.addEventListener("scroll", (event) => {
        let scroll = this.scrollY;
        console.log(scroll);
    });
</script>

<div class="container pt-1">
    <div class="row">
        <h1>Criar - {{ $hq->tema }}, pág. {{ $quadrinho->pagina }}</h1>
    </div>
    <a class="btn btn-outline-dark" href="{{ route('hq.show', $hq->id) }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</a>
    <button class="btn btn-outline-dark ml-2" onclick="javascript:location.reload()"><i class="fa fa-undo" aria-hidden="true"></i> Recarregar</button>
</div>
<hr class="bg-dark"/>


<div class="p-3">

    <div class="form-group row">
        <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Fala do autor:</label>
        <div class="col-sm-8">
            <input id="txt-titulo" type="text" class="form-control" name="titulo" maxlength="255" value="{{ $quadrinho->titulo }}" placeholder="Se o autor houver fala. Adicione-a aqui.">
        </div>
    </div>

    <h3 class="text-center">Arraste os itens abaixo!</h3>
    
    <div class="container">
        <div class="btn-group w-100 mb-0">
            <button id="btn-balao" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#balao">
                Balão de fala
            </button>
            <button id="btn-utensilio" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#utensilio">
                Objetos
            </button>
        </div>
        @php
            // para verificar se imagem repete ou não
            $repeteX = ($hq->ambiente->repeteFundo) ? 'background-repeat: repeat-x' : '';
        @endphp
        <div class="container containerCustomizado" id="fundo" style="background-color: white; background-image: url('{{ $caminho_imagem.$hq->ambiente->fundo }}'); {{ $repeteX }}">
            <div class="row" >
                <div class="col-12">
                    <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2">
                        <div id="personagem1" class="arrastavel personagem personagem1" ondblclick="espelharImagem(event)" oncontextmenu="mostraBotoes(event)" style="z-index: 101; background-image: url('{{ $caminho_imagem.$hq->personagem1->personagem }}')">
                            <button id="btnRotate" type="button" class="btn btn-dark operacoesPersonagem" style="display: none"><i class="fas fa-adjust"></i></button>
                        </div>
                        <div class="arrastavel personagem personagem2" ondblclick="espelharImagem(event)" style="z-index: 100; background-image: url('{{ $caminho_imagem.$hq->personagem2->personagem }}')"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container" id="semEstilo">
        <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-success" onclick="baixaQuadrinho({{ $hq->id }}, {{ $quadrinho->id }})"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar Quadrinho</button>
            </div>
        </div>
    </div>

    <div class="container" id="semEstilo">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('quadrinho.update', $quadrinho->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="output-quadrinho">
                        {{-- onde Fica o quadro para baixar --}}
                        {{-- <input type="hidden" name="id" value="{{ $quadrinho->id }}"> --}}
                    </div>
                    <div id="titulo-escondido">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   

@include('quadrinhos.modal.balaoFala')
@include('quadrinhos.modal.utensilio')

{{-- função Javascrit para selecionar opção presente nos modais --}}
<script>

    function mostraBotoes(e) {
        e.preventDefault();
        // var personagem = e.target;
        var btnRotate = $(this).children('#btnRotate');
        $("#btnRotate").toggle();
        btnRotate.toggle();
        console.log(btnRotate);

        eventoBotao(e);
        // personagem.append(button);

    }

    // function eventoBotao(e){
    //     // var btnRotate = document.getElement("#btnRotate").clicked;
    //     // console.log(btnRotate);
    //     document.getElementById("btnRotate").click(function(event){
    //         espelharImagem(event);
    //         console.log(espelharImagem(event));
    //     });

    //     // if(document.getElementById("btnRotate").onclick){
    //     //     alert("button was clicked");
    //     // }
    // }

    var teste = true;
    function espelharImagem(e){
        var imagem = e.target;
        var transform;
        if(teste){
            transform = "scaleX(-1)";
            teste = false;
        }else {
            transform = "scaleX(1)";
            teste = true;
        }

        imagem.style.webkitTransform = transform;
        imagem.style.transform = transform;
    }


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

    // let balaoMsg = document.getElementById("balaoMsg");
    // console.log(balaoMsg); 
    // balaoMsg.addEventListener("contextmenu", function(){
    //     console.log(balaoMsg); 
    // });
</script>


@endsection
