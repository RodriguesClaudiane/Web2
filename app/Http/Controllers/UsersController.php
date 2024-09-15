<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index()
    {
        Gate::authorize('administrador', User::class);
        $librarians = User::where('role','bibliotecario')->get();
        return view('manage.index', compact('librarians'));
    }
    public function renderUpdateUserRole()
    {
        Gate::authorize('administrador', User::class);
        return view('manage.edit');
    }


    public function updateUserRole(Request $request)
    {
        Gate::authorize('administrador', User::class);

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user->role = 'bibliotecario';
            $user->save();
            return redirect()->route('manage.index')->with('success', 'Bibliotecário adicionado com sucesso!');
        }else{
            return redirect()->back('manage.renderUpdateUserRole')->with('error', 'Usuário não encontrado. Verifique se o email digitado está correto.');
        }
    }
    public function demoteUser($id)
    {
        Gate::authorize('administrador', User::class);
        $user = User::findOrFail($id);

        $user->role = 'cliente';
        $user->save();

        return redirect()->route('manage.index')->with('success', 'Bibliotecário removido com sucesso!');
    }
}
