<div class="mt-5">
    <h1 class="text-center ">Cadastrar Sensor</h1>
    <div class="card position-absolute top-50 start-50 translate-middle ">
        <div class="card-body">

            <form class="row g-3" wire:submit.prevent='store'>
                <div class="col-12">
                    <label for="nome" class="form-label">Código</label>
                    <input type="text" class="form-control" id='nome' placeholder="" wire:model='codigo'>
                </div>
                <div class="col-12">
                    <label for="valor" class="form-label">Tipo</label>
                    <input type="text" class="form-control" id='valor' placeholder="" wire:model='tipo'>
                </div>
                <div class="col-12">
                    <label for="valor" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id='valor' placeholder="" wire:model='descricao'>
                </div>
                <div class="col-12">
                    <label for="valor" class="form-label">Ambiente ID</label>
                    <input type="text" class="form-control" id='valor' placeholder="" wire:model='ambiente_id'>
                </div>
                <div class="form-check">
                    <p>Status</p>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="switchCheckDefault"
                            wire:model='status'>
                        <label class="form-check-label" for="switchCheckDefault"> Ativo</label>
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
