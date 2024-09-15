@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bibliotecários</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <a href="{{ route('manage.renderUpdateUserRole') }}" class="btn btn-primary mb-3">Adicionar Bibliotecário</a>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($librarians as $librarian)
        <tr>
            <td>{{ $librarian->name }}</td>
            <td>{{ $librarian->email }}</td>
            <td>
                <form action="{{ route('manage.demoteUser', $librarian->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja remover {{ $librarian->name }} do cargo de bibliotecário?')">Remover bibliotecário</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
