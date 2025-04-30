@extends('layouts.app')

@section('title', 'Tableau')

@section('content')
    <h2>Tableau d'exemple</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>1</td><td>Jean Dupont</td><td>jean@example.com</td></tr>
            <tr><td>2</td><td>Marie Claire</td><td>marie@example.com</td></tr>
        </tbody>
    </table>
@endsection
