<!-- Modal Personagem 2 -->
<div class="modal fade" id="personagem2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 2</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarP2()">Confirmar</button>
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
                                            <input type="radio" id="{{ $personagem->id }}" name="personagem2_id" value="{{ $personagem->id }}" data-descricao="{{ $personagem->descricao }}" data-img="{{ $personagem->personagem }}" onclick="checked_radio()">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarP2()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 2 -->

<!-- Javascript de Confirmação de seleção personagem 2 -->
<script>

    function confirmarP2(){
        let personagem2 = document.querySelector("#btn-personagem2");
        let radio_personagem2 = document.getElementsByName("personagem2_id");

        for (let i = 0; i < radio_personagem2.length; i++) {
            const el = radio_personagem2[i];
            if(el.checked){
                // console.log(el);
                let personagem = el.getAttribute("data-descricao");
                let img = el.getAttribute("data-img");
                personagem2.textContent = "Personagem Selecionado: " + personagem;

                let imagem = document.createElement("img");
                imagem.src = "{!! $caminho_imagem !!}" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                personagem2.appendChild(imagem);
            }
            
        }
    }

</script>
<!-- Fim Javascript de Confirmação de seleção personagem 2 -->