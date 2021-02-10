<div class="card text-center border border-dark shadow">
    <div class="card-header">
        &nbsp;
    </div>
    <div class="card-body">
        <h5 class="card-title">"{{$software->descricao}}" ainda não possui Histórias em Quadrinhos!</h5>
        <p class="card-text">Clique no Botão abaixo para criar uma HQ.</p>
        <a href="{{ route('criarHq', ['softwareId' => $software->id]) }}" class="btn btn-primary">
            <i class="fa fa-plus" aria-hidden="true"></i> Criar HQ
        </a>
    </div>
    <div class="card-footer text-muted">
        &nbsp;
    </div>
</div>
