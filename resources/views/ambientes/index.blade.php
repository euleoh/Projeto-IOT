@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">ORGANIZAÇÃO</span><h1>Ambientes</h1><p>Organize os locais monitorados pela sua instalação.</p></div><a href="{{ route('ambientes.create') }}" class="btn btn-primary">+ Novo ambiente</a></div>
<div class="d-flex justify-content-between align-items-center mb-3"><div class="section-heading"><div><h2>Todos os ambientes</h2><span class="text-secondary small">{{ $ambientes->total() }} cadastrado(s)</span></div></div></div>
<div class="card-panel">
@if($ambientes->isEmpty())
    <div class="empty-state"><div class="empty-icon">▦</div><h3 class="h5 text-dark">Nenhum ambiente por aqui</h3><p>Cadastre o primeiro ambiente para começar a organizar os sensores.</p><a href="{{ route('ambientes.create') }}" class="btn btn-primary mt-2">Cadastrar ambiente</a></div>
@else
<div class="responsive-table"><table class="table"><thead><tr><th>Ambiente</th><th>Sensores</th><th>Status</th><th class="text-end">Ações</th></tr></thead><tbody>
@foreach($ambientes as $ambiente)
<tr><td><div class="entity-title">{{ $ambiente->nome }}</div><div class="entity-sub">{{ \Illuminate\Support\Str::limit($ambiente->descricao, 72) }}</div></td><td><span class="badge rounded-pill text-bg-light">{{ $ambiente->sensores_count }}</span></td><td><span class="badge-status {{ $ambiente->status ? 'status-on' : 'status-off' }}">{{ $ambiente->status ? 'Ativo' : 'Inativo' }}</span></td><td class="text-end"><a class="action-link" href="{{ route('ambientes.edit', $ambiente) }}">Editar</a><form class="d-inline" method="POST" action="{{ route('ambientes.destroy', $ambiente) }}" onsubmit="return confirm('Excluir o ambiente {{ addslashes($ambiente->nome) }}? Ambientes com sensores não podem ser excluídos.')">@csrf @method('DELETE')<button class="action-link action-delete" type="submit">Excluir</button></form></td></tr>
@endforeach
</tbody></table></div>
@if($ambientes->hasPages())<div class="p-3 border-top">{{ $ambientes->links() }}</div>@endif
@endif
</div>
@endsection
