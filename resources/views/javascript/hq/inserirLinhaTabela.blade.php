<script>

    // colocado aqui pois há código blade, apenas javascript mostra como erro
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //problematizar
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
                    
                    criarLinhaTabela(response, 'tabProblematizar');
                    atualizarNumeroPagina();
                }
            });
        });

        //solucionar
        $("#btn_adicionarSolucionar").click(function(e) {
            e.preventDefault();
            var data = $("#hqId");

            $.ajax({
                type: "POST",
                url: '{!! URL::to('solucionar/store') !!}',
                dataType: "json",
                data: data,
                success: function(response) {
                    var trSolucionar = $("#ultimaLinhaSolucionar");

                    criarLinhaTabela(response, 'tabSolucionar')
                }
            });
        });

    });

    function criarLinhaTabela(response, tabFase){
        var tr = document.createElement("tr");
        var tdFase = document.createElement("th");
        var tdTitulo = document.createElement("td");
        var tdPagina = document.createElement("td");
        var tdOperacoes = document.createElement("td");
        
        adicionarValoresColuna(tdFase,tdTitulo,tdPagina,response, tabFase);

        if(tabFase == 'tabSolucionar'){
            criarBotoesOperacoes(tdOperacoes, response.solucionarId, response.solucionar.id,response.solucionarPagina, 'solucionar');
        } else {
            criarBotoesOperacoes(tdOperacoes, response.problematizarId, response.problematizar.id,response.problematizarPagina, 'problematizar');
        }
                    
        adicionarClasseColuna(tr,tdFase,tdOperacoes,tdPagina,tdTitulo);
        adicionandoElementos(tr,tdFase,tdOperacoes,tdPagina,tdTitulo);
        
        $(tr).insertBefore(`#${inserirDps(tabFase)}`);
    }

    function adicionarValoresColuna(tdFase,tdTitulo,tdPagina,response, tabFase){
        tdFase.append(document.querySelector(`#${tabFase}`).textContent);
        tdTitulo.append("");
        
        if(tabFase == "tabSolucionar"){
            tdPagina.setAttribute("id", "atualizarNumeroPagina");
            tdPagina.append(response.solucionarPagina);
            tdPagina.textContent++; // necessário para deixar o número das páginas correto ao adicionar solucionar
        }else{
            tdPagina.append(response.problematizarPagina);
        }
    }

    function adicionarClasseColuna(tr,tdFase,tdOperacoes,tdPagina,tdTitulo){
        tdFase.classList.add("align-middle");
        tdOperacoes.classList.add("align-middle");
        tdPagina.classList.add("align-middle");
        tdTitulo.classList.add("align-middle");

        tdOperacoes.classList.add("d-inline-flex");
        tr.style.borderBottom = "2px solid #555";
    }

    function adicionandoElementos(tr,tdFase,tdOperacoes,tdPagina,tdTitulo){
        tr.appendChild(tdFase);
        tr.appendChild(tdTitulo);
        tr.appendChild(tdPagina);
        tr.appendChild(tdOperacoes);
    }

    function criarBotoesOperacoes(td, idQuadrinho, idPagina, pagina, fase) {
        let rota = 'problematizar';
        if(fase == 'solucionar'){
            rota = 'solucionar';
            pagina++;
        }

        return td.innerHTML = `
            <a href="{{ env('APP_URL') }}/mostrarQuadrinho/{!! $hq->id !!}/${idQuadrinho}" class="btn btn-sm btn-info"><i class="fas fa-plus"></i> Adicionar</a>
            <form class="ml-1" action="{{ env('APP_URL') }}/${rota}/${idPagina}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Deseja realmente remover o quadrinho - página ${pagina}?')">
                    <i class="fas fa-trash"></i> Remover
                </button>
            </form>
        `;
    }

    function inserirDps(tabFase){
        let inserirDps = 'linhasProblematizar'
        if(tabFase == 'tabSolucionar'){
            inserirDps ='linhasSolucionar';
        }
        return inserirDps;
    }

    function atualizarNumeroPagina() {
        var paginas = document.querySelectorAll("#atualizarNumeroPagina");
        for (let i = 0; i <= paginas.length; i++) {
            const element = paginas[i];
            let number = parseInt(element.textContent);
            number++;
            element.textContent = number;
        }
    }

</script>