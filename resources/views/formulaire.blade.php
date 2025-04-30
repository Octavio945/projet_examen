@extends('layouts.app')

@section('title', 'Formulaire')

@section('content')
    <h2>Formulaire d'exemple</h2>
    <form method="POST" action="#">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email :</label>
            <input type="email" class="form-control" id="email" name="email">
        </div>
        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
@endsection