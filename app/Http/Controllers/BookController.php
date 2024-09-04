<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationData;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Função para exibir uma lista de livros
    public function index()
    {
        $books = Book::with(['author', 'publisher', 'categories'])->get();
        return view('books.index', compact('books'));
    }

    // Função para exibir um livro específico
    public function show($id)
    {
        $book = Book::with(['author', 'publisher', 'categories'])->findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Função para exibir o formulário de criação de um novo livro
    public function create()
    {
        Gate::authorize('librarian', User::class);
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('books.create', compact('authors', 'publishers', 'categories'));
    }

    // Função para armazenar um novo livro no banco de dados
    public function store(Request $request)
    {
        Gate::authorize('librarian', User::class);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover' => 'required|file|image'
        ]);

        $bookCover = $validatedData['cover']->store('covers', 'public');
        $validatedData['cover'] = $bookCover;
        $book = Book::create($validatedData);
        $book->categories()->attach($request->categories);

        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso!');
    }

    // Função para exibir o formulário de edição de um livro
    public function edit($id)
    {
        Gate::authorize('librarian', User::class);
        $book = Book::findOrFail($id);
        $authors = Author::all();
        $publishers = Publisher::all();
        $categories = Category::all();
        return view('books.edit', compact('book', 'authors', 'publishers', 'categories'));
    }

    // Função para atualizar um livro no banco de dados
    public function update(Request $request, $id)
    {
        Gate::authorize('librarian', User::class);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|integer',
            'publisher_id' => 'required|integer',
            'published_year' => 'required|integer',
            'categories' => 'required|array',
            'cover' => 'required|file|image'
        ]);

        $bookCover = $validatedData['cover']->store('covers', 'public');
        $validatedData['cover'] = $bookCover;

        $book = Book::findOrFail($id);
        $book->update($validatedData);
        $book->categories()->sync($request->categories);

        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso!');
    }

    // Função para excluir um livro do banco de dados
    public function destroy($id)
    {
        Gate::authorize('librarian', User::class);
        $book = Book::findOrFail($id);
        Storage::delete('public/' . $book->cover);
        $book->categories()->detach();
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso!');
    }
}

