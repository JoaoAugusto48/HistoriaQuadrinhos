$(document).ready(() => {

    inicializarAplicacao();

});


function inicializarAplicacao(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
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
}


function baixaQuadrinho(){
    $("#output-quadrinho").html('');
    imprimeDiv($('#fundo'));
}

function imprimeDiv(div){
    html2canvas(div, {
        onrendered: function(canvas) {
            let div = document.createElement("div");
            div.classList.add("container");;
            div.appendChild(canvas);

            document.body.appendChild(div);
            $("#output-quadrinho").append('<h4> clique com o botao direito na imagem abaixo para salva-la!</h4>');
            $("#output-quadrinho").append(canvas);
            
        }
    });
}
