<!-- Modal utensilio -->
<div class="modal fade" id="utensilio" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Balão</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarUtensilio()">Confirmar</button>
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
                                            <img src="{{ env('APP_URL') }}/storage/{{ $utensilio->caminho }}" class="card-img-top">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarUtensilio()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal utensilio -->

<!-- Javascript de Confirmação de seleção utensilio -->
<script>

    function confirmarUtensilio(){
        let utensilio = document.querySelector("#btn-utensilio");
        let radio_utensilio = document.getElementsByName("utensilio_id");

        for (let i = 0; i < radio_utensilio.length; i++) {
            const el = radio_utensilio[i];
            if(el.checked){
                // console.log(el);
                // let descricao = el.getAttribute("data-descricao");
                // let img = el.getAttribute("data-img");
                // utensilio.textContent = "Balão Selecionado: " + descricao;

                // let imagem = document.createElement("img");
                // imagem.src = "{{ env('APP_URL') }}/storage/" + img;
                // imagem.classList.add("img-btn");
                // imagem.classList.add("ml-2");

                utensilio.appendChild(imagem);
            }
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção utensilio -->
