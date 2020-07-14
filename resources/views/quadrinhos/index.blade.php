<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QUADRINHOS</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{ asset('css/index.css') }}">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

</head>
<body style="background-color: rgba(220, 220, 226, 0.781)">
 {{-- {{ $hq->id }} --}}
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

                        <div class="arrastavel balao p-1" style="background-image: url('{{ env('APP_URL') }}/storage/{{ $balao->caminho }}')">
                            <textarea rows="3" cols="13" class="text-center balaoContent" style="height:50px; border:none; outline:none; padding:5px; margin: 25px 0px 0px 13px; resize: none; width:80%; height:40%; overflow-y: hidden; line-height:15px;"></textarea>
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
            <div class="col-12">
                <div class="col-9" id="output-quadrinho">
                    {{-- onde Fica o quadro para baixar --}}
                </div>
            </div>
        </div>
    </div>
</div>   


<script>
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
</script>

<script src="{{ asset('js/index.js') }}"></script>
</body>
</html>