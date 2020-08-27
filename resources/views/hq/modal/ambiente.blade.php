<!-- Modal Ambiente -->
<div class="modal fade" id="ambiente" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Ambiente</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarAmbiente()">Confirmar</button>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="card-group">
                        @foreach ($ambientes as $ambiente)
                        <div class="col-md-4">
                            <label class="hiddenradio">
                                <div class="card mb-5 text-center" style="width: 12rem;">
                                    <div class="card-content">
                                        <div class="card-header card-title">{{ $ambiente->descricao }}</div>
                                        <div class="card-body align-center">
                                            <input type="radio" id="{{ $ambiente->id }}" name="ambiente_id" value="{{ $ambiente->id }}" data-descricao="{{ $ambiente->descricao }}" data-img="{{ $ambiente->fundo }}" onclick="checked_radio()">
                                            <img src="{{ $caminho_imagem.$ambiente->fundo }}" class="card-img-top">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarAmbiente()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Ambiente -->

<!-- Javascript de Confirmação de seleção ambiente -->
<script>

    function confirmarAmbiente(){
        let ambiente = document.querySelector("#btn-ambiente");
        let radio_ambiente = document.getElementsByName("ambiente_id");

        for (let i = 0; i < radio_ambiente.length; i++) {
            const el = radio_ambiente[i];
            if(el.checked){
                // console.log(el);
                let descricao = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                ambiente.textContent = "Ambiente Selecionado: " + descricao;

                let imagem = document.createElement("img");
                imagem.src = "{!! $caminho_imagem !!}" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                ambiente.appendChild(imagem);
            }
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção ambiente -->