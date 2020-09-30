<!-- Modal utensilio -->
<div class="modal fade" id="utensilio" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Balão</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarUtensilio('{{$caminho_imagem}}')">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($utensilios as $utensilio)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $utensilio->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $utensilio->id }}" name="utensilio_id" value="{{ $utensilio->id }}" data-descricao="{{ $utensilio->descricao }}" data-img="{{ $utensilio->caminho }}" onclick="checked_radio()">
                                            <img src="{{ $caminho_imagem.$utensilio->caminho }}" class="card-img-top">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarUtensilio('{{$caminho_imagem}}')">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal utensilio -->

<!-- Javascript de Confirmação de seleção utensilio -->
<script>
    function confirmarUtensilio(caminho_imagem){
        

        let utensilio = document.querySelector("#btn-utensilio");
        let radio_utensilio = document.getElementsByName("utensilio_id");

        for (let i = 0; i < radio_utensilio.length; i++) {
            const el = radio_utensilio[i];
            if(el.checked){
                console.log(el);
                let descricao = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                utensilio.textContent = "Objeto Selecionado: ";

                let imagem = document.createElement("img");
                imagem.src = caminho_imagem + img;
                imagem.classList.add("modal-utensilio-btn");

                utensilio.appendChild(imagem);

                let utensilioImg = document.createElement("div");

                utensilioImg.id = "utensilioImg";
                utensilioImg.classList.add("arrastavel");
                utensilioImg.classList.add("arrastavelUtensilio");
                utensilioImg.setAttribute("data-toggle", "tooltip");
                utensilioImg.setAttribute("data-html", "true");
                utensilioImg.setAttribute("data-placement", "top");
                utensilioImg.setAttribute("ondblclick", "espelharImagem(event)"); // para espelhar a imagem
                utensilioImg.setAttribute("title", "Clique com o botão direito para remover.<hr class='border-white m-0'> Dê duplo click para inverter a imagem.");
                utensilioImg.oncontextmenu = function(event) {
                    event.preventDefault();
                    this.remove();
                };
                // balaoMsg.classList.add("ui-draggable");
                // balaoMsg.classList.add("ui-draggable-handle");
                // balaoMsg.classList.add("ui-resizable");
                utensilioImg.style.backgroundImage = "url({{ env('APP_URL') }}/storage/"+img+")";
                
                let outputQuadrinho = document.getElementById("acopla-imagens");
                outputQuadrinho.append(utensilioImg);

                colocarUtensilio();
            }
        }
    }
</script>
<!-- Fim Javascript de Confirmação de seleção utensilio -->
