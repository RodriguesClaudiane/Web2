@extends('layouts.app')

@section('content')
<div class="container">
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
