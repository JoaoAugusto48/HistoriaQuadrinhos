{{-- função Javascrit para selecionar opção presente nos modais --}}
<script>

    function mostraBotoes(e) {
        e.preventDefault();
        // var personagem = e.target;
        var btnRotate = $(this).children('#btnRotate');
        $("#btnRotate").toggle();
        btnRotate.toggle();
        console.log(btnRotate);

        eventoBotao(e);
        // personagem.append(button);

    }

    // function eventoBotao(e){
    //     // var btnRotate = document.getElement("#btnRotate").clicked;
    //     // console.log(btnRotate);
    //     document.getElementById("btnRotate").click(function(event){
    //         espelharImagem(event);
    //         console.log(espelharImagem(event));
    //     });

    //     // if(document.getElementById("btnRotate").onclick){
    //     //     alert("button was clicked");
    //     // }
    // }

    var teste = true;
    function espelharImagem(e){
        var imagem = e.target;
        var transform;
        if(teste){
            transform = "scaleX(-1)";
            teste = false;
        }else {
            transform = "scaleX(1)";
            teste = true;
        }

        imagem.style.webkitTransform = transform;
        imagem.style.transform = transform;
    }


    function checked_radio() {
        let radioButtons = document.querySelectorAll("input[type='radio']");

        for (let i = 0; i < radioButtons.length; i++) {
            const el = radioButtons[i];

            if (el.checked) {
                el.closest(".card").classList.add("card-checked");
            } else {
                el.closest(".card").classList.remove("card-checked");
            }
        }
    }

    // let balaoMsg = document.getElementById("balaoMsg");
    // console.log(balaoMsg);
    // balaoMsg.addEventListener("contextmenu", function(){
    //     console.log(balaoMsg);
    // });
</script>