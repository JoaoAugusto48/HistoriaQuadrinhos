function trocarExibicao(){
    // $('#col-adicionar').fadeOut(100);
    setTimeout(function(){
    
        $('#col-img').fadeIn(100);
        $('#col-descricao').fadeIn(100);
        $('#col-enviar').fadeIn(100);
        $('#col-formImg').show(100);
        $('#col-fechar').show(100);

        if($('#col-check').length > 0){
            $('#col-check').show(100);
        }
    }, 50)
}