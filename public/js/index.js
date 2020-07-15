$(document).ready(() => {

    inicializarAplicacao();

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
        maxHeight: 300,
        maxWidth: 200,
        minHeight: 150,
        minWidth: 75
    });

}


function baixaQuadrinho(){
    $("#output-quadrinho").html('');
    imprimeDiv($('#fundo'));
}

function imprimeDiv(div){
    html2canvas(div, {
        onrendered: function(canvas) {
            let div = document.createElement("div");
            div.classList.add("container");
            div.appendChild(canvas);

            console.log(div)

            document.body.appendChild(div);
            $("#output-quadrinho").append('<h4> clique com o botao direito na imagem abaixo para salva-la!</h4>');
            $("#output-quadrinho").append(canvas);
            
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
