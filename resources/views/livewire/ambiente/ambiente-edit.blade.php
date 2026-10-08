<div>
    <div class="card position-absolute top-50 start-50 translate-middle">
        <div class="card-body">
            <h1>Editar Ambiente</h1>
            <form class="row g-3" wire:submit.prevent='update'>
                <div class="col-12">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id='nome' placeholder="" wire:model='nome'>
                </div>
                <div class="col-12">
                    <label for="valor" class="form-label">Descricão</label>
                    <input type="text" class="form-control" id='valor' placeholder="" wire:model='descricao'>
                </div>
                <div class="form-check">
                    <p>Status</p>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault"
                            wire:model='status'>
                        <label class="form-check-label" for="switchCheckDefault"> </label>
                    </div>
                </div>
                <div>
                    <div class="col-12 m-3">
                        <button type="submit" class="btn btn-primary"> Salvar</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
