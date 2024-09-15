@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bibliotecários</h1>
    <a href="{{ route('manage.edit') }}" class="btn btn-primary mb-3">Adicionar Nova Categoria</a>
    <thead>
    <tr>Nome</tr>
    <tr>Email</tr>
    </thead>
    <tbody>
    @foreach ($librarians as $librarian)
    <tr>
        <td>{{ $librarian->name }}</td>
        <td>{{ $librarian->email }}</td>>
    </tr>
    @endforeach
    </tbody>
</div>
@endsection
