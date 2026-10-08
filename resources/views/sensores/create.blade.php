@extends('layouts.app')
@section('content')
<div class="page-heading"><div><span class="eyebrow">NOVO DISPOSITIVO</span><h1>Criar sensor</h1><p>Vincule o dispositivo a um ambiente da sua instalação.</p></div></div>
@if($ambientes->isEmpty())<div class="alert alert-warning">Antes de continuar, <a href="{{ route('ambientes.create') }}" class="alert-link">cadastre um ambiente</a>.</div>@endif
<form method="POST" action="{{ route('sensores.store') }}" class="card-panel form-card">@csrf @include('sensores._form')<div class="d-flex gap-2"><button type="submit" class="btn btn-primary" @disabled($ambientes->isEmpty())>Salvar sensor</button><a href="{{ route('sensores.index') }}" class="btn btn-light">Cancelar</a></div></form>
@endsection
