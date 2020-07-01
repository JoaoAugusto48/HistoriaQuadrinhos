$(document).ready(() => {

    inicializarAplicacao();

});


function inicializarAplicacao(){
    
    let acopladorImagens = document.querySelector('.acopla-imagens');

    $( ".arrastavel" ).draggable({
      /*  stop: function(element) {
            let elemento = element.target.outerHTML;
            elemento = elemento.split('style')[0];

            console.log(acopladorImagens.childElementCount);
            elemento += 'style="margin-left: -150px">';
            console.log(elemento);
            acopladorImagens.innerHTML+=elemento;
            inicializarAplicacao();
          }*/
    });
}


function baixaQuadrinho(){
    $("#output-quadrinho").html('');
    imprimeDiv($('body'));
}

function imprimeDiv(div){
    html2canvas(div, {
        onrendered: function(canvas) {
            document.body.appendChild(canvas);
            $("#output-quadrinho").append('<h4> clique com o botao direito na imagem abaixo para salva-la!</h4>');
            $("#output-quadrinho").append(canvas);
        }
    });
}
