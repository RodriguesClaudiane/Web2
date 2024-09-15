@extends('layouts.app')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <a href="{{ route('manage.index') }}" class="btn btn-secondary mb-3">Voltar para a listagem</a>
    <h1>Adicionar novo bibliotecário</h1>
    <div class="mb-3">
        <form action="{{ route('manage.updateUserRole') }}" method="POST">
            @csrf
            @method('PUT')
            <label for="email" class="form-label">
                Email do novo bibliotecário:
            </label>
            <input type="email" id="email" class="form-control" name="email" placeholder="Digite aqui o email do novo bibliotecário" required>
            <button type="submit" class="btn btn-primary">Adicionar bibliotecário</button>
        </form>
    </div>
</div>
@endsection
