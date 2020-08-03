$(document).ready(() => {

    inicializarAplicacao();




    var titulo = document.getElementById("txt-titulo");
    var inputTitulo = document.createElement("input");
    inputTitulo.type = "hidden";
    inputTitulo.name = titulo.name;

    titulo.addEventListener("input",function(){
        inputTitulo.value = titulo.value;
    })
    
    $("#titulo-escondido").append(inputTitulo);



});

// function mostrarBalao(){
//     var click = document.getElementById("drop-content");
//     if(click.style.display === "none"){
//         click.style.display = "block";
//     } else {
//         click.style.display = "nome";
//     }
// }

function inicializarAplicacao(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
        containment: "#fundo", 
        scroll: false


        // stop: function(element) {
        //     let elemento = element.target.outerHTML;
        //     elemento = elemento.split('style')[0];

        //     console.log(acopladorImagens.childElementCount);
        //     elemento += 'style="margin-left: -150px">';
        //     console.log(elemento);
        //     acopladorImagens.innerHTML+=elemento;
        //     inicializarAplicacao();
        //   }
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



function baixaQuadrinho(hqId, quadrinhoId){
    $("#output-quadrinho").html('');
    imprimeDiv($('#fundo'),hqId, quadrinhoId);

    $('html, body').animate({
        scrollTop: $("#output-quadrinho").offset().top
        }, 500);
}

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
            $("#output-quadrinho").append('<button type="submit" class="btn btn-success m-3">Salvar</button>');
            
            
        }
    });
}

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
