@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">ATUALIZAÇÃO</span><h1>Editar sensor</h1><p>Altere as informações de <strong>{{ $sensor->codigo }}</strong>.</p></div></div>
<form method="POST" action="{{ route('sensores.update', $sensor) }}" class="card-panel form-card">@csrf @method('PUT') @include('sensores._form')<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">Salvar alterações</button><a href="{{ route('sensores.index') }}" class="btn btn-light">Cancelar</a></div></form>
@endsection
