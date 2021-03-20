// Para o usuário baixar a Hq de seu desejo.
function baixarHq(nomeSoftware,nomeHq){
    $("#baixar-hq").html('');

    imprimeHq($("#baixarQuadrinho"), nomeSoftware, nomeHq);
}

function imprimeHq(div, nomeSoftware, nomeHq){
    html2canvas(div, {
        onrendered: function(canvas) {
            var myImage = canvas.toDataURL();
            console.log(myImage);
            downloadURI(myImage, nomeSoftware, nomeHq);
            
            // // apenas para teste, excluir depois
            // let div = document.createElement("div");
            // div.classList.add("container");
            
            // div.appendChild(canvas);

            // document.body.appendChild(div);
            // // $("#output-hq").append('<h4>Clique em salvar para guardar a imagem!</h4>');
            // // $("#output-quadrinho").append('<h4>clique com o botao direito na imagem abaixo para salva-la!</h4>');
            // $("#output-hq").append(canvas);
        }
    });
}

function downloadURI(uri, software, hq) {
    var link = document.createElement("a");
    
    link.download = `${software}_${hq}`;
    link.href = uri;
    document.body.appendChild(link);
    link.click();   
    //after creating link you should delete dynamic link
    document.body.removeChild(link);
    delete link;
}
