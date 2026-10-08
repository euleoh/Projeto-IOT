@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">NOVO CADASTRO</span><h1>Criar ambiente</h1><p>Adicione um espaço monitorado à instalação.</p></div></div>
<form method="POST" action="{{ route('ambientes.store') }}" class="card-panel form-card">@csrf @include('ambientes._form')<div class="d-flex gap-2"><button type="submit" class="btn btn-primary">Salvar ambiente</button><a href="{{ route('ambientes.index') }}" class="btn btn-light">Cancelar</a></div></form>
@endsection
