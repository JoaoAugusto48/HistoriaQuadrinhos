// função para atualizar o titulo do quadrinho
// caso o usuário o atualize o titulo após apertar o botão de visualizar
$(document).ready(() => {

    inicializarAplicacao();

    var titulo = document.getElementById("txt-titulo");
    var inputTitulo = document.createElement("input");
    inputTitulo.type = "hidden";
    inputTitulo.name = titulo.name;
    inputTitulo.value = titulo.value; 
    
    $("#titulo-escondido").append(inputTitulo);
    titulo.addEventListener("input",function(){
        inputTitulo.value = titulo.value;
    });
})

// Estado inicial da página
function inicializarAplicacao(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
        containment: "#fundo", 
        scroll: false
    });

    $( ".arrastavel" ).resizable({
        containment: "#fundo",
        maxHeight: 260,
        maxWidth: 180,
        minHeight: 100,
        minWidth: 50
    });

    $( ".balao" ).resizable({
        containment: "#fundo",
        maxHeight: 200,
        maxWidth: 200,
        minHeight: 75,
        minWidth: 75
    });
}

function colocarBalao(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
        containment: "#fundo", 
        scroll: false
    });

    $( ".arrastavel" ).resizable({
        containment: "#fundo",
        maxHeight: 180,
        maxWidth: 180,
        minHeight: 70,
        minWidth: 70
    });
}

function colocarUtensilio(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
        containment: "#fundo", 
        scroll: false
    });

    $( ".arrastavel" ).resizable({
        containment: "#fundo",
        maxHeight: 200,
        maxWidth: 200,
        minHeight: 100,
        minWidth: 100
    });

}

// Função para baixar o quadrinho
function baixaQuadrinho(hqId, quadrinhoId){
    $("#output-quadrinho").html('');
    imprimeDiv($('#fundo'),hqId, quadrinhoId);

    $('html, body').animate({
        scrollTop: $("#output-quadrinho").offset().top
    }, 500);
}

// Local onde o usuário poderá ver a imagem gerada e salvar 
function imprimeDiv(div, hqId, quadrinhoId){
    html2canvas(div, {
        onrendered: function(canvas) {
            let div = document.createElement("div");
            div.classList.add("container");
            
            div.appendChild(canvas);

            
            document.body.appendChild(div);
            $("#output-quadrinho").append('<h4>Clique em salvar para guardar a imagem!</h4>');
            // $("#output-quadrinho").append('<h4>clique com o botao direito na imagem abaixo para salva-la!</h4>');
            $("#output-quadrinho").append(canvas);

            // Código referente a Hq
            var hq = hqId;
            var inputHqId = document.createElement("input");
            inputHqId.type = "hidden";
            inputHqId.value = hq;
            inputHqId.name = "hqId";
            $("#output-quadrinho").append(inputHqId);

            // Código referente ao Quadrinho
            var codigo = quadrinhoId;
            var inputId = document.createElement("input");
            inputId.type = "hidden";
            inputId.value = codigo;
            inputId.name = "quadrinhoId";
            $("#output-quadrinho").append(inputId);
            
            //convertendo canvas para imagem
            var image = new Image();
            image.src = canvas.toDataURL("image/png");
            image.name = "imgQuadrinho";
            // $("#output-quadrinho").append(image);

            var input = document.createElement("input");
            input.type = "text";
            input.value = image.src;
            input.name = "imgQuadrinho";
            input.style.display = "none";
            $("#output-quadrinho").append(input);

            // ("#output-quadrinho").append('<form action=""></form>');$
            $("#output-quadrinho").append('<button type="submit" class="btn btn-success m-3"><i class="fa fa-download" aria-hidden="true"></i> Salvar</button>');
            
            
        }
    });
}


