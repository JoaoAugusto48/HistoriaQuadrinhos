<!-- Modal Balao -->
<div class="modal fade" id="balao" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Balão</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarBalao()">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($balaos as $balao)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $balao->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $balao->id }}" name="balao_id" value="{{ $balao->id }}" data-descricao="{{ $balao->descricao }}" data-img="{{ $balao->caminho }}" onclick="checked_radio()">
                                            <img src="{{ env('APP_URL') }}/storage/{{ $balao->caminho }}" class="card-img-top">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarBalao()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal balao -->

<!-- Javascript de Confirmação de seleção balao -->
<script>

    function confirmarBalao(){
        let balao = document.querySelector("#btn-balao");
        let radio_balao = document.getElementsByName("balao_id");

        for (let i = 0; i < radio_balao.length; i++) {
            const el = radio_balao[i];
            if(el.checked){
                // console.log(el);
                let descricao = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                balao.textContent = "Balão Selecionado: " + descricao;

                let imagem = document.createElement("img");
                imagem.src = "{{ env('APP_URL') }}/storage/" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");
                
                balao.appendChild(imagem);

                let balaoMsg = document.createElement("div");
                balaoMsg.classList.add("arrastavel");
                balaoMsg.classList.add("arrastavelBalao");
                // balaoMsg.classList.add("ui-draggable");
                // balaoMsg.classList.add("ui-draggable-handle");
                // balaoMsg.classList.add("ui-resizable");
                balaoMsg.style.backgroundImage = "url({{ env('APP_URL') }}/storage/"+img+")";

                let txtBalao = "<textarea rows='3' cols='13' class='text-center balaoContent txtBalao'></textarea>";
                balaoMsg.innerHTML = txtBalao;
                
                let outputQuadrinho = document.getElementById("acopla-imagens");
                outputQuadrinho.append(balaoMsg);

                colocarBalao();

            }
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção balao -->
