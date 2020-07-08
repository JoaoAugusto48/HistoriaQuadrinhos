<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QUADRINHOS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

</head>
<body style="background-color: rgba(220, 220, 226, 0.781)">
 {{-- {{ $hq->id }} --}}
<div class="p-5">
    <div class="container containerCustomizado" id="fundo" style="background-color: white">
    {{-- <div class="container containerCustomizado" style="background-color: white"> --}}
        <div class="row" style="background-color: white">
            <div class="col-12" style="border-bottom: 3px solid black; background-color: white">
                <h3 class="text-center">Arraste os itens abaixo!</h3>
                <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2">
                    <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}')"></div>
                    <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}')"></div>
                </div>
            </div>
            {{-- <div class="container containerCustomizado" id="fundo" style="background-color: blue">
                teste
            </div> --}}
            {{-- <div class="col-9 acopla-imagens" id="acopla-imagens" style="display: flex; align-items: stretch; z-index:2; background-color: black">
                    <div id="fundo">
                        
                    </div>    
                    <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem1->personagem }}')"></div>
                    <div class="arrastavel" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $hq->personagem2->personagem }}')"></div>
            </div> --}}
        </div>
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
            <div class="col-12">
                <div class="col-9" id="output-quadrinho">
                    {{-- onde Fica o quadro para baixar --}}
                </div>
            </div>
        </div>
    </div>
</div>   

<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>