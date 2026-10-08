<?php

namespace App\Http\Controllers;

use App\Models\Ambiente;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AmbienteController extends Controller
{
    public function index(): View
    {
        return view('ambientes.index', [
            'ambientes' => Ambiente::withCount('sensores')->orderBy('nome')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('ambientes.create', ['ambiente' => new Ambiente()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:2000'],
            'status' => ['sometimes', 'boolean'],
        ]);
        $data['status'] = $request->boolean('status');

        Ambiente::create($data);

        return redirect()->route('ambientes.index')->with('success', 'Ambiente cadastrado com sucesso.');
    }

    public function edit(Ambiente $ambiente): View
    {
        return view('ambientes.edit', compact('ambiente'));
    }

    public function update(Request $request, Ambiente $ambiente): RedirectResponse
    {
        $data = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:2000'],
            'status' => ['sometimes', 'boolean'],
        ]);
        $data['status'] = $request->boolean('status');
        $ambiente->update($data);

        return redirect()->route('ambientes.index')->with('success', 'Ambiente atualizado com sucesso.');
    }

    public function destroy(Ambiente $ambiente): RedirectResponse
    {
        if ($ambiente->sensores()->exists()) {
            return redirect()->route('ambientes.index')->with('error', 'Este ambiente ainda possui sensores. Remova ou mova os sensores antes de excluí-lo.');
        }

        $ambiente->delete();

        return redirect()->route('ambientes.index')->with('success', 'Ambiente excluído com sucesso.');
    }
}
