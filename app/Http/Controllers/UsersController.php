<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $librarians = User::where('role','librarian')->get();
        return view('manage.index', compact('librarians'));
    }
    public function updateUserRole(Request $request)
    {
        // Validação do email
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Busca o usuário pelo email
        $user = User::where('email', $request->email)->firstOrFail();

        // Altera a role para 'librarian'
        $user->role = 'librarian';
        $user->save();

        // Redireciona de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'O usuário foi atualizado para bibliotecário.');
    }
}
