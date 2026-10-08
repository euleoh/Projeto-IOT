@extends('layouts.app')

@section('content')
    <section class="hero-panel mb-4">
        <div class="hero-copy">
            <span class="eyebrow">PAINEL DE MONITORAMENTO</span>
            <h1>Seus espaços, sob controle.</h1>
            <p>Gerencie ambientes e sensores conectados em um só lugar.</p>
            <a href="{{ route('ambientes.index') }}" class="btn btn-light btn-lg mt-2">Abrir ambientes <span aria-hidden="true">→</span></a>
        </div>
        <div class="hero-decoration" aria-hidden="true"><span>◌</span></div>
    </section>

    <div class="section-heading mb-3">
        <div><span class="eyebrow">VISÃO GERAL</span><h2>Resumo da instalação</h2></div>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-4"><a class="stat-card" href="{{ route('ambientes.index') }}"><span class="stat-icon icon-lilac">⌂</span><span class="stat-label">Ambientes cadastrados</span><strong>{{ \App\Models\Ambiente::count() }}</strong><span class="stat-link">Gerenciar ambientes →</span></a></div>
        <div class="col-md-4"><a class="stat-card" href="{{ route('sensores.index') }}"><span class="stat-icon icon-mint">⌁</span><span class="stat-label">Sensores cadastrados</span><strong>{{ \App\Models\Sensor::count() }}</strong><span class="stat-link">Gerenciar sensores →</span></a></div>
        <div class="col-md-4"><div class="stat-card"><span class="stat-icon icon-amber">◉</span><span class="stat-label">Sensores ativos</span><strong>{{ \App\Models\Sensor::where('status', true)->count() }}</strong><span class="stat-link">Prontos para monitorar</span></div></div>
    </div>
    <div class="quick-actions">
        <div><span class="eyebrow">COMECE POR AQUI</span><h2>Cadastre um novo item</h2><p>Organize a instalação antes de conectar seus dispositivos.</p></div>
        <div class="d-flex flex-wrap gap-2"><a href="{{ route('ambientes.create') }}" class="btn btn-primary">+ Novo ambiente</a><a href="{{ route('sensores.create') }}" class="btn btn-outline-primary">+ Novo sensor</a></div>
    </div>
@endsection
