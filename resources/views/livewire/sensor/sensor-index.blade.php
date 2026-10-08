<div class="mt-5">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Painel dos Sensores</h2>
            <div class="d-flex gap-2">
                <a class="btn btn-secondary mt-4" href="{{ route('sensor.create') }}"> Adicionar Sensor </a>
            </div>
        </div>
        @if (session()->has('error '))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <input type="text" wire:model.live='search' placeholder="Pesquisar" class="form-control mb-4">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Código</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Ambiente ID</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sensores as $s)
                        <tr>
                            <th scope="sensores">{{ $s->id }}</th>
                            <td>{{ $s->codigo }}</td>
                            <td>{{ $s->descricao }}</td>
                            <td>
                                <input class="form-check-input" type="checkbox" role="switch"
                                    id="status-{{ $s->id }}" wire:click="status ({{ $s->id }})"
                                    @checked($s->status)>
                                <span class=" mx-2 badge bg-{{ $s->status ? 'success' : 'danger' }}">
                                    {{ $s->status ? 'ATIVO' : 'INATIVO' }}
                                </span>
                            </td>
                            <td>{{ $s->tipo }}</td>
                            <td>{{ $s->ambiente_id }}</td>
                            <td>
                                <a href="{{ route('sensor.edit', ['id' => $s->id]) }}"
                                    class="btn btn-sm btn-outline-success bi bi-pencil-fill"></a>

                                <button wire:click='delete({{ $s->id }})'
                                    class="btn btn-sm btn-outline-danger bi bi-trash-fill"></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
