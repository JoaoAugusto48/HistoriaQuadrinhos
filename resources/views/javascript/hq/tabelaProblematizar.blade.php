<script>

    // colocado aqui pois há código blade, apenas javascript mostra como erro
    //problematizar
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#btn_adicionarProblematizar").click(function(e) {
            e.preventDefault();
            var data = $("#hqId");

            $.ajax({
                type: "POST",
                url: '{!! URL::to('problematizar/store') !!}',
                dataType: "json",
                data: data,
                success: function(response) {
                    var trProblematizar = $("#ultimaLinhaProblematizar");
                    
                    var tr = document.createElement("tr");
                    var tdFase = document.createElement("th");
                    tdFase.append(document.querySelector('#tabProblematizar').textContent);

                    var tdTitulo = document.createElement("td");
                    tdTitulo.append("");

                    var tdPagina = document.createElement("td");
                    tdPagina.append(response.problematizarPagina);
                    // https://laracasts.com/discuss/channels/laravel/how-to-display-belongsto-in-ajax-with-laravel?page=1
                    var tdOperacoes = document.createElement("td");
                    criarBotoesOperacoesProblematizar(tdOperacoes, response.problematizarId, response.problematizar.id,response.problematizarPagina);
                    
                    tdFase.classList.add("align-middle");
                    tdOperacoes.classList.add("align-middle");
                    tdPagina.classList.add("align-middle");
                    tdTitulo.classList.add("align-middle");
                    tdOperacoes.classList.add("d-inline-flex");

                    tr.appendChild(tdFase);
                    tr.appendChild(tdTitulo);
                    tr.appendChild(tdPagina);
                    tr.appendChild(tdOperacoes);

                    tr.style.borderBottom = "2px solid #555";
                    // style="border-bottom: 2px solid #555;"
                    
                    
                    // trProblematizar.append("<tr><td>TESTE1</td><td>TESTE2</td><td>TESTE3</td><td>TESTE4</td></tr>")
                    $(tr).insertBefore("#linhasProblematizar")
                    atualizarNumeroPagina();
                }
            });
        })
    });


    function criarBotoesOperacoesProblematizar(td, idProblematizar, idPagina, pagina) {
        return td.innerHTML = `
                        <a href="{{ env('APP_URL') }}/mostrarQuadrinho/{!! $hq->id !!}/${idProblematizar}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Adicionar</a>
                        <form class="ml-1" action="{{ env('APP_URL') }}/problematizar/${idPagina}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente remover o quadrinho - página ${pagina}?')">
                                <i class="fas fa-trash"></i> Remover
                            </button>
                        </form>
        `;

    }

</script>