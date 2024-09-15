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
    public function update(Request $request)
    {
        $request->validate([
        'email' => 'required|email|exists:users,email'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user->role = 'librarian';
            $user->save();
            return redirect()->route('manage.index')->with('success', 'Categoria criada com sucesso!');
        }
            return redirect()->route('manage.index')->with('error', 'Usuário não encontrado!');
    }
}
