<!-- Modal Personagem 1 -->
<div class="modal fade" id="personagem1" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personagem 1</h5>
                <button type="button" class="btn btn-success ml-3" data-dismiss="modal" onclick="confirmarP1()">Confirmar</button>
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
                                            <input type="radio" id="{{ $personagem->id }}" name="personagem1_id" value="{{ $personagem->id }}" data-descricao="{{ $personagem->descricao }}" data-img="{{ $personagem->personagem }}" onclick="checked_radio()">
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
                <button type="button" class="btn btn-success" id="buttonCloseModal" data-dismiss="modal" onclick="confirmarP1()">Confirmar</button>
                {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
            </div>
        </div>
    </div>
</div>
<!-- Fim Modal Personagem 1 -->

<!-- Javascript de Confirmação de seleção personagem 1 -->
<script>

    function  confirmarP1() {
        let personagem1 = document.querySelector("#btn-personagem1");
        let radio_personagem1 = document.getElementsByName("personagem1_id");

        for (let i = 0; i < radio_personagem1.length; i++) {
            const el = radio_personagem1[i];
            if(el.checked){
                // console.log(el);
                let personagem = el.getAttribute("data-descricao");
                personagem1.textContent = "Personagem Selecionado: " + personagem;
                let img = el.getAttribute("data-img");

                let imagem = document.createElement("img");
                imagem.src = "{!! $caminho_imagem !!}" + img;
                imagem.classList.add("img-btn");
                imagem.classList.add("ml-2");

                personagem1.appendChild(imagem);
            }
            
        }

        // console.log(radio_personagem1);
    }

</script>
<!-- Fim javascript de confirmação de seleção personagem 1 -->