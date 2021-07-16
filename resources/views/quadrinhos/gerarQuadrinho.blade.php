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
            <label for="nome" class="col-sm-12 col-form-label text-center">
                <span class="font-weight-bold">{{ $faseQuadrinho['fase'] }}</span>
                -
                {{ $faseQuadrinho['mensagem'] }}
            </label>
        </div>
        <div class="form-group row">
            <label for="nome" class="col-sm-2 col-form-label text-right font-weight-bold">Fala do autor:</label>
            <div class="col-sm-8">
                <input id="txt-titulo" type="text" class="form-control" name="titulo" maxlength="255"
                    value="{{ $quadrinho->titulo }}" placeholder="Se o autor houver fala. Adicione-a aqui."
                    onblur="reconheceObjetos()">
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

            <div class="container containerCustomizado p-0" id="fundo"
                style="background-color: white; background-image: url('{{ $caminho_imagem . $hq->ambiente->fundo }}'); {{ $repeteX }}">
                <div class="row">
                    <div class="col-12">
                        <div class="acopla-imagens" id="acopla-imagens"
                            style="display: flex; align-items: stretch; z-index:2">
                            {{-- <div id="personagem1" class="arrastavel personagem personagem1" ondblclick="espelharImagem(event)" oncontextmenu="mostraBotoes(event)" style="z-index: 101; background-image: url('{{ $caminho_imagem.$hq->personagem1->personagem }}')">
                                <button id="btnRotate" type="button" class="btn btn-dark operacoesPersonagem" style="display: none"><i class="fas fa-adjust"></i></button>
                            </div> --}}
                            <div id="personagemImg" class="arrastavel personagem personagem1"
                                style="z-index: 101; background-image: url('{{ $caminho_imagem . $hq->personagem1->personagem }}')">
                                <button type="button" class="btn btn-dark operacoesPersonagem" style="display: none"><i
                                        class="fas fa-adjust"></i>
                                </button>
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

        @include('quadrinhos.cardMensagens')

        <div class="container mt-2" id="semEstilo">
            <div class="row">
                <div class="col-12 mb-3">
                    <button class="btn btn-success" onclick="baixaQuadrinho({{ $hq->id }}, {{ $quadrinho->id }})"
                        id="baixar">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        Visualizar Quadrinho
                    </button>
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
        // botão de visualização do quadrinho
        let btnVisualizarQuadrinho = document.getElementById("baixar");
        // altura do canvas -> usado em "mensagemRetorno"
        let itemFundo = document.getElementById('fundo');
        let canvasHeight = itemFundo.offsetHeight;
        // para recuperar os eventos quando tiver algo sendo inserido no DOM
        // itemFundo.addEventListener("DOMNodeInserted", function(ev) {
        //     reconheceObjetos();
        // })
        window.addEventListener("load", function() {
            reconheceObjetos();
            // itemFundo.addEventListener("DOMNodeInserted", function(ev) {
            //     reconheceObjetos();
            // })
        });

        // icons
        let dangerIcon = '<i class="fas fa-times"></i>';
        let warningIcon = '<i class="fas fa-exclamation-triangle"></i>';
        let successIcon = '<i class="fas fa-check"></i>';

        // pegar a posição da tela 

        // evento para verificar texto do narrador
        // narrador.addEventListener('input', inputNarrador());


        // variáveis para selecionar os items que possuem esses atributos
        let personagem = $("div[id^=personagemImg]").length;
        let balao = $("div[id^=balaoMsg]").length;
        let fundo = $("div[id^=fundo]").length; // fundo é um utensilio
        let utensilio = $("div[id^=utensilioImg]").length + fundo;

        // console para mostrar os valores
        console.log("Personagem: " + personagem);
        console.log("Balão: " + balao);
        console.log("Utensilio: " + utensilio);

        document.getElementById("personagem").addEventListener("click", function(e) {
            personagem = $("div[id^=personagemImg]").length;
            console.log("Personagem: " + personagem);
            // reconheceObjetos();
        });

        document.getElementById("balao").addEventListener("click", function(e) {
            balao = $("div[id^=balaoMsg]").length;
            console.log("Balão: " + balao);
            // reconheceObjetos();
        });

        document.getElementById("utensilio").addEventListener("click", function(e) {
            utensilio = $("div[id^=utensilioImg]").length;
            console.log("Utensilio: " + utensilio);
            // reconheceObjetos();
        });

        // var elementTop = document.getElementById('fundo').offsetTop;
        // console.log(elementTop);

        function reconheceObjetos() {
            adicionaEventListeners();
            // objeto para colocar os items no array
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
                    // posicaoY = verifica em relação ao meio da tela   
                    posicaoY: 0,
                    imagemUrl: '',
                    larguraProprioObjeto: 0,
                    alturaProprioObjeto: 0,
                    tipoObjeto: 0
                }

                let bounding = objetosQuadrinho[i].getBoundingClientRect();
                // console.log('item dentro canvas: ' +objetosQuadrinho[i].offsetTop);

                // objeto.posicaoCima = parseInt(bounding.top);
                objeto.posicaoCima = parseInt(objetosQuadrinho[i].offsetTop);
                objeto.posicaoBaixo = parseInt(objetosQuadrinho[i].offsetTop + objetosQuadrinho[i].offsetHeight);
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

            mensagemRetorno(retorno);
            // console.log(retorno);
        }

        //deve ser chamada na criação do objeto e ao inicializar a página
        function adicionaEventListeners() {

            let objetosQuadrinho = document.getElementsByClassName('arrastavel');

            for (let i = 0; i < objetosQuadrinho.length; i++) {
                // objetosQuadrinho[i].removeEventListener('blur', function(){}, false);
                objetosQuadrinho[i].addEventListener('mouseup', reconheceObjetos);
                objetosQuadrinho[i].addEventListener('contextmenu', reconheceObjetos);
            }
        }

        // observações
        // Não pode ter 'comunicação' sem personagems
        // objetos são aceitos em todos os casos, a menos que não tenha nada, deve ter título no quadrinho
        // personagens são aceitos em todos os casos, caso não tenha balão de fala, deve ter ao menos fala do narrador
        // balões, é necessário que tenha ao menos um personagem para que possa ser aceito
        function mensagemRetorno(items) {
            // console.log(canvasHeight); // Altura do Canvas

            let resultados = document.getElementById('resultados');
            resultados.innerHTML = null;

            let personagems = [];
            let objetos = [];
            let balaos = [];

            for (let i = 0; i < items.length; i++) {
                if (items[i].tipoObjeto == 1) {
                    personagems.push(items[i]);
                } else
                if (items[i].tipoObjeto == 2) {
                    objetos.push(items[i])
                } else {
                    balaos.push(items[i]);
                }
            }

            // console.log(personagems.length);
            // console.log(objetos.length + fundo);
            // console.log(balaos.length);

            // para testar se o narrador tem valor
            let narrador = inputNarrador();
            // console.log('Fala narrador: ' + narrador);

            let warning = false;
            let danger = false;

            // Validações que não precisam se looping
            if (!narrador && (personagems.length == 0)) {
                // Se não tiver Narrador e Personagens 
                // console.log('não pode');
                mensagemResultados('text-danger', dangerIcon,
                    'É necessária a presença de Fala do narrador ou de algum Personagem');
                danger = true;
            }

            if (!narrador && (balaos.length == 0)) {
                // Se não tiver Narrador e Comunicação
                // console.log('não pode');
                mensagemResultados('text-danger', dangerIcon,
                    'É necessário a presença de Fala do narrador ou Balão de Fala');
                danger = true;
            }

            if ((personagems.length == 0) && (balaos.length > 1)) {
                // Se não tiver Personagem mas tiver Comunicação 
                // console.log('não pode');
                mensagemResultados('text-danger', dangerIcon,
                    'É necessário que adicione algum Personagem, ou remova o Balão de Fala');
                danger = true;
            }

            warning = validarPersonagem(warning, personagems);
            danger = validarBalao(danger, balaos, personagems);
            validarObjetos(objetos);

            // para retornar a mensagem ao usuário
            // console.log(items);
            // console.log(danger, warning);

            estadoQuadrinho(warning, danger);
        }

        function validarPersonagem(warning, personagems) {
            for (let i = 0; i < personagems.length; i++) {
                // console.log(items[i].posicaoCima);
                if (personagems[i].posicaoBaixo < (canvasHeight - 150) && personagems[i].tipoObjeto == 1) {
                    // console.log("Lançar Warning");
                    warning = true;
                    mensagemResultados('text-warning', warningIcon,
                        'Talvez o personagem esteja um pouco a cima do esperado');
                }
            }
            return warning;
        }

        function validarBalao(danger, balaos, personagems) {
            // console.log('Ainda não implementado');
            let balaoNoPersonagem = false;
            let balaoNoBalaoPersonagem = false;
            let balaoFora = false;
            // let condicaoFinal = false;

            for (let i = 0; i < balaos.length; i++) {
                balaoNoPersonagem = false;
                balaoNoBalaoPersonagem = false
                balaoFora = true;
                // para testar o balão com a proximidade com os personagens 
                for (let j = 0; j < personagems.length; j++) {
                    // teste para comparar a posição do quadrinho com a posição dos personagens
                    // console.log('Balão: ' +(balaos[i].posicaoEsquerda+ ' Personagem: ' + personagems[j].posicaoDireita));
                    if ((balaos[i].posicaoEsquerda < personagems[j].posicaoDireita) &&
                        (balaos[i].posicaoDireita > personagems[j].posicaoEsquerda) &&
                        (balaos[i].posicaoCima < personagems[j].posicaoBaixo) &&
                        (balaos[i].posicaoBaixo > personagems[j].posicaoCima)) {

                        console.log('O balão está dentro da área permitida');
                        balaoNoPersonagem = true;
                        balaoFora = false;
                    } else {
                        console.log('Balão: erro');
                    }
                }

                for (let j = 0; j < balaos.length; j++) {
                    if (i != j) {
                        // teste para comparar a posição do quadrinho com a posição de outro balões
                        // console.log('Balão: ' +(balaos[i].posicaoEsquerda+ ' Personagem: ' + personagems[j].posicaoDireita));
                        if ((balaos[i].posicaoEsquerda < balaos[j].posicaoDireita) &&
                            (balaos[i].posicaoDireita > balaos[j].posicaoEsquerda) &&
                            (balaos[i].posicaoCima < balaos[j].posicaoBaixo) &&
                            (balaos[i].posicaoBaixo > balaos[j].posicaoCima)) {

                            console.log('O balão está dentro da área de outro balão');
                            balaoNoBalaoPersonagem = true;
                            balaoFora = false;
                        } else {
                            console.log('Balão: está errado');
                        }

                    }
                }

                // if (balaoNoPersonagem || balaoNoBalaoPersonagem) {
                //     mensagemResultados('text-success', successIcon, 'Balão está OK');
                //     if(balaoNoBalaoPersonagem){
                //         mensagemResultados('text-success', successIcon, 'Balão está dentro de outro Balão');
                //     }
                if ((balaoNoPersonagem || balaoNoBalaoPersonagem) && !balaoFora) {
                    if (balaoNoPersonagem) {
                        mensagemResultados('text-success', successIcon, 'Balão está no pesonagem');
                    } else if (balaoNoBalaoPersonagem) {
                        mensagemResultados('text-success', successIcon, 'Balão está no balão');
                    } else{
                        mensagemResultados('text-success', successIcon, 'Balão está OK');
                    }
                } else {
                    mensagemResultados('text-danger', dangerIcon,
                        'O balão está errado');
                    danger = true;
                }
            }

            return danger;
        }

        function validarObjetos(objetos) {
            console.log('Ainda não implementado');
        }


        // para mostrar o atual estado da HQ, responsável pela validação do botão de salvar
        function estadoQuadrinho(warning, danger) {
            // Para retornar os estados dos items ao usuário

            if (danger) {
                desabilitaBotao();
                mensagemEstado('text-danger', dangerIcon, 'Erro');
            } else if (warning) {
                habilitaBotao();
                mensagemEstado('text-warning', warningIcon, 'Atenção');
            } else {
                habilitaBotao();
                mensagemEstado('text-success', successIcon, 'Sucesso');
                mensagemResultados('text-success', successIcon, 'Todos os items estão de acordo');
            }
        }

        function mensagemResultados(textColor, icone, message = 'Não há mensagem, contatar equipe de suporte') {
            let mensagem = document.getElementById("resultados");
            // console.log(mensagem);

            let texto = document.createElement("p");
            texto.classList.add("card-text");
            texto.classList.add("m-0");
            texto.classList.add(textColor);
            // console.log(mensagem); //retirar
            mensagem.appendChild(texto);
            texto.innerHTML += `${icone} ${message}`;
            // texto.innerHTML += message;
        }

        function mensagemEstado(textColor, icone, message) {
            // para mostrar a mensagem
            let mensagem = document.getElementById("resposta");
            mensagem.innerHTML = null;

            let texto = document.createElement("p");
            texto.classList.add("card-text");
            texto.classList.add("m-0");
            texto.classList.add(textColor);
            // console.log(mensagem); //retirar
            mensagem.appendChild(texto);
            texto.innerHTML = `${icone} ${message}`;
        }

        function inputNarrador() {
            let narrador = document.getElementById('txt-titulo');
            let textoNarrador = false;
            if (narrador.value.length > 0) {
                textoNarrador = true;
            }
            return textoNarrador;
        }

        // para desabilitar o botão de visualização do quadrinho
        function desabilitaBotao() {
            btnVisualizarQuadrinho.disabled = true;
        }

        // para habilitar o botão de visualização do quadrinho
        function habilitaBotao() {
            btnVisualizarQuadrinho.disabled = false;
        }
    </script>


@endsection
