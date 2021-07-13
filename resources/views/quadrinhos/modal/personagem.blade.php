<!-- Modal Personagem -->
<div class="modal fade" id="personagem" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarPersonagem('{{$caminho_imagem}}'); reconheceObjetos();">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($personagems as $personagem)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $personagem->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $personagem->id }}" name="personagem_id" value="{{ $personagem->id }}" data-descricao="{{ $personagem->descricao }}" data-img="{{ $personagem->personagem }}" onclick="checked_radio()">
                                            <img src="{{ $caminho_imagem.$personagem->personagem }}" class="card-img-top">
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarPersonagem('{{$caminho_imagem}}'); reconheceObjetos();">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem -->

<!-- Javascript de Confirmação de seleção Personagem -->
<script>

    function  confirmarPersonagem(caminho_imagem) {
        let personagem = document.querySelector("#btn-personagem");
        let radio_personagem = document.getElementsByName("personagem_id");

        for (let i = 0; i < radio_personagem.length; i++) {
            const el = radio_personagem[i];
            if(el.checked){
                // console.log(el);
                let descricao = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                personagem.textContent = "Personagem Selecionado: ";

                let imagem = document.createElement("img");
                imagem.src = caminho_imagem + img;
                imagem.classList.add("modal-btn");

                personagem.appendChild(imagem);

                let personagemImg = document.createElement("div");

                personagemImg.id = "personagemImg";
                personagemImg.classList.add("arrastavel");
                personagemImg.classList.add("arrastavelPersonagem");
                // personagemImg.setAttribute("data-toggle", "tooltip");
                // personagemImg.setAttribute("data-html", "true");
                // personagemImg.setAttribute("data-placement", "top");
                personagemImg.setAttribute("ondblclick", "espelharImagem(event)"); // para espelhar a imagem
                // personagemImg.setAttribute("title", "Clique com o botão direito para remover.<hr class='border-white m-0'> Dê duplo click para inverter a imagem.");
                personagemImg.setAttribute("title", "Clique com o botão direito para remover. Dê duplo click para inverter a imagem.");
                personagemImg.oncontextmenu = function(event) {
                    event.preventDefault();
                    this.remove();
                };
                // balaoMsg.classList.add("ui-draggable");
                // balaoMsg.classList.add("ui-draggable-handle");
                // balaoMsg.classList.add("ui-resizable");
                personagemImg.style.backgroundImage = "url({{ env('APP_URL') }}/storage/"+img+")";
                
                let outputQuadrinho = document.getElementById("acopla-imagens");
                outputQuadrinho.append(personagemImg);

                colocarPersonagem();
            }
            
        }

        // console.log(radio_personagem);
    }

</script>
<!-- Fim javascript de confirmação de seleção personagem -->