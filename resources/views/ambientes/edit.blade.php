@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">ATUALIZAÇÃO</span><h1>Editar ambiente</h1><p>Altere as informações de <strong>{{ $ambiente->nome }}</strong>.</p></div></div>
<form method="POST" action="{{ route('ambientes.update', $ambiente) }}" class="card-panel form-card">@csrf @method('PUT') @include('ambientes._form')<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">Salvar alterações</button><a href="{{ route('ambientes.index') }}" class="btn btn-light">Cancelar</a></div></form>
@endsection
