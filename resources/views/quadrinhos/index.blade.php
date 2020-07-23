@php
    $titulo = $hq->tema;
@endphp
@extends('criarQuadrinho')

@section('content')
    
<div class="container pt-3">
    <button class="btn btn-outline-dark" onclick="javascript:history.back()">Voltar</button>
    <button class="btn btn-outline-dark ml-2" onclick="javascript:location.reload()">Recarregar</button>
</div>

<div class="p-3">
    <h3 class="text-center">Arraste os itens abaixo!</h3>
    
    
    <div class="container containerCustomizado" id="fundo" style="background-color: white; background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->ambiente->fundo }}')">
    {{-- <div class="container containerCustomizado" style="background-color: white"> --}}
        <div class="row" >
            {{-- <div class="col-12" style="border-bottom: 3px solid black"> --}}
            <div class="col-12">
                <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2">
                    
                    <div class="arrastavel personagem" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}')" oncontextmenu="show_hide();return false;"></div>
                    <div class="arrastavel personagem" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}')" oncontextmenu="show_hide();return false;">
                    
                    </div>
                </div>

                <div id="baloes" style="display: none;">
                    {{-- https://www.youtube.com/watch?v=w88U9JA70wQ --}}
                    @foreach ($balaos as $balao)
                        {{-- <textarea rows="3" cols="3" class="arrastavel text-center balaoContent" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $balao->caminho }}'); border:none; outline:none; padding:5px"></textarea> --}}
                        {{-- background:transparent --}}
                        <div class="arrastavel balao p-1" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $balao->caminho }}')">
                            <textarea rows="3" cols="13" class="text-center balaoContent" style="background:transparent;height:50px; border:none; outline:none; padding:5px; margin: 15px 0px 0px 13px; resize: none; width:80%; height:50%; overflow-y: hidden; line-height:15px; font-size:14px;"></textarea>
                        </div>
                    @endforeach
                </div>
                
            </div>
            {{-- <div class="col-12 border-top bg-info h-100" id="fundo" >
                asd
            </div> --}}
            {{-- <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2; background-color: black">
                <div id="fundo">
                    
                </div>    
                <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}')"></div>
                <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}')"></div>
            </div> --}}
        </div>
        {{-- <div class="row"  style="background-color: yellow" id="fundo">
            <div class="col-12">
                <h1>teste</h1>
            </div>
        </div> --}}
        {{-- <div class="container containerCustomizado" id="fundo" style="background-color: blue">
            teste
        </div> --}}
    </div>
    <br>
    <div class="container" id="semEstilo">
        <div class="row">
            <div class="col-12 mb-3">
                <button class="btn btn-success" onclick="baixaQuadrinho()">Baixar Quadrinho</button>
            </div>
        </div>
    </div>

    <div class="container ml-4" id="semEstilo">
        <div class="row">
            <div class="col-12 ml-4">
                <form action="{{ route('hq.index') }}">
                    <div class="col-9" id="output-quadrinho">
                    {{-- onde Fica o quadro para baixar --}}
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>   


{{-- <script>
    function show_hide() {
        var img = document.getElementById('personagem');
        // console.log(img);
        // var button = document.createElement('button');
        // button.type = "button";
        // button.classList.add("btn");
        // button.classList.add("btn-primary");
        // button.classList.add("marginDoTopo");

        // var i = document.createElement('i');
        // i.classList.add("fas");
        // i.classList.add("fa-plus");

        // button.appendChild(i);

        // img.appendChild(button);
        // console.log(img);

        var baloes = document.getElementById("baloes");

        if(baloes.style.display === "none") {
            baloes.style.display = "block";
        } else {
            baloes.style.display = "none";
        }
    }
</script> --}}

@endsection