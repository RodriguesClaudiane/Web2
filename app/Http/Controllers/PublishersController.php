<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PublishersController extends Controller
{

    public function index()
    {
       $publishers = Publisher::with('books')->get();
       return view('publishers.index', compact('publishers'));

    }

    public function show($id)
    {
        $publisher = Publisher::with('books')->findOrFail($id);
        return view('publishers.show', compact('publisher'));

    }

    public function create()
    {
        Gate::authorize('bibliotecario', User::class);
        return view('publishers.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('bibliotecario', User::class);
       $validatedData = $request->validate([
           'name' => 'required|string|max:255',
           'address' => 'nullable|string|max:255',
       ]);

       Publisher::create($validatedData);

       return redirect()->route('publishers.index')->with('success', 'Editora criada com sucesso!');

    }

    public function edit($id)
    {
        Gate::authorize('bibliotecario', User::class);
          $publisher = Publisher::findOrFail($id);
          return view('publishers.edit', compact('publisher'));

    }

    public function update(Request $request, $id)
    {
        Gate::authorize('bibliotecario', User::class);
       $validatedData = $request->validate([
                  'name' => 'required|string|max:255',
                  'address' => 'nullable|string|max:255',
              ]);

              $publisher = Publisher::findOrFail($id);
              $publisher->update($validatedData);

              return redirect()->route('publishers.index')->with('success', 'Editora atualizada com sucesso!');

    }

    public function destroy($id)
    {
        Gate::authorize('bibliotecario', User::class);
       $publisher = Publisher::findOrFail($id);
               $publisher->delete();

               return redirect()->route('publishers.index')->with('success', 'Editora excluída com sucesso!');

    }
}
