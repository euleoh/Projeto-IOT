@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">DISPOSITIVOS</span><h1>Sensores</h1><p>Cadastre e acompanhe os dispositivos vinculados aos ambientes.</p></div><a href="{{ route('sensores.create') }}" class="btn btn-primary">+ Novo sensor</a></div>
<div class="d-flex justify-content-between align-items-center mb-3"><div><h2>Todos os sensores</h2><span class="text-secondary small">{{ $sensores->total() }} cadastrado(s)</span></div></div>
<div class="card-panel">
@if($sensores->isEmpty())
    <div class="empty-state"><div class="empty-icon">⌁</div><h3 class="h5 text-dark">Nenhum sensor cadastrado</h3><p>Cadastre um ambiente primeiro e depois associe seus sensores.</p><a href="{{ route('sensores.create') }}" class="btn btn-primary mt-2">Cadastrar sensor</a></div>
@else
<div class="responsive-table"><table class="table"><thead><tr><th>Sensor</th><th>Ambiente</th><th>Registros</th><th>Status</th><th class="text-end">Ações</th></tr></thead><tbody>
@foreach($sensores as $sensor)
<tr><td><div class="entity-title">{{ $sensor->codigo }} <span class="entity-sub d-inline">· {{ $sensor->tipo }}</span></div><div class="entity-sub">{{ \Illuminate\Support\Str::limit($sensor->descricao, 64) }}</div></td><td>{{ $sensor->ambiente->nome }}</td><td><span class="badge rounded-pill text-bg-light">{{ $sensor->registros_count }}</span></td><td><span class="badge-status {{ $sensor->status ? 'status-on' : 'status-off' }}">{{ $sensor->status ? 'Ativo' : 'Inativo' }}</span></td><td class="text-end"><a class="action-link" href="{{ route('sensores.edit', $sensor) }}">Editar</a><form class="d-inline" method="POST" action="{{ route('sensores.destroy', $sensor) }}" onsubmit="return confirm('Excluir o sensor {{ addslashes($sensor->codigo) }}? Os {{ $sensor->registros_count }} registros históricos associados também serão apagados.')">@csrf @method('DELETE')<button class="action-link action-delete" type="submit">Excluir</button></form></td></tr>
@endforeach
</tbody></table></div>
@if($sensores->hasPages())<div class="p-3 border-top">{{ $sensores->links() }}</div>@endif
@endif
</div>
@endsection
