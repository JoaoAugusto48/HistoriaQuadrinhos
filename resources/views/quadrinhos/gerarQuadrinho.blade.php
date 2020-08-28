{{-- @extends('layouts.criarQuadrinho') --}}
@extends('layouts.app')
{{-- @section('title', $hq->tema) --}}

@section('content')
    

<script>
//     function capturaPosicaoDoMouse(event){
//    // console.log(event);
// }

// function capturaPosicaoDoClick(event){
//     const posicoes = {x : event.clientX, y : event.clientY + window.scrollY};
//     console.log(posicoes);

//     document.querySelector("#fundo").innerHTML+=
//     `
//     <div class="balaozin" oncontextmenu="excluiQuadradin(event)" style="width: 50px; display: block; height: 50x; background-color: pink; position: absolute; left: ${posicoes.x}px; top: ${posicoes.y}px">
//     teste
//     </div>
    
//     `;
// }

// function excluiQuadradin(event){
//     console.log(event.path[0].style.display="none");
//     event.preventDefault();
//     return false;
// }

</script>



<div class="container pt-1">
    <div class="row">
        <h1>Criar - {{ $hq->tema }}, pág. {{ $quadrinho->pagina }}</h1>
    </div>
    <button class="btn btn-outline-dark" onclick="javascript:history.back()"><i class="fa fa-reply" aria-hidden="true"></i> Voltar</button>
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
            {{-- <div class="col-sm-6"> --}}
                <button id="btn-balao" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#balao">
                    Balão de fala
                </button>
            {{-- </div>
            <div class="col-sm-6"> --}}
                <button id="btn-utensilio" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#utensilio">
                    Objetos
                </button>
            {{-- </div> --}}
        </div>
    
        {{-- Com funcões referentes ao uso do mouse --}}
        {{-- <div class="container containerCustomizado" id="fundo" onmousemove="capturaPosicaoDoMouse(event)" onclick="capturaPosicaoDoClick(event)" style="background-color: white; background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}')"> --}}
        
        {{-- Sem funcões referentes ao uso do mouse --}}
        <div class="container containerCustomizado" id="fundo" style="background-color: white; background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}')">
        {{-- <div class="container containerCustomizado" style="background-color: white"> --}}
            <div class="row" >
                {{-- <div class="col-12" style="border-bottom: 3px solid black"> --}}
                <div class="col-12">
                    <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2">
                        
                        {{-- Com context menu --}}
                        {{-- <div class="arrastavel personagem" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}')" oncontextmenu="show_hide();return false;"></div>
                        <div class="arrastavel personagem" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}')" oncontextmenu="show_hide();return false;"> --}}
                        
                        {{-- Sem context menu --}}
                        <div class="arrastavel personagem" style="z-index: 100; background-image: url('{{ $caminho_imagem.$hq->personagem1->personagem }}')"></div>
                        <div class="arrastavel personagem" style="z-index: 101; background-image: url('{{ $caminho_imagem.$hq->personagem2->personagem }}')"></div>
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
