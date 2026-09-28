@extends('layouts.app')

@section('titre', 'Erreur technique')

@section('contenu')

<section class="bande" style="min-height:56vh;display:grid;align-items:center">
    <div class="wrap" style="text-align:center">
        <span class="ref">Erreur 500</span>

        <h1 style="margin:20px auto 18px;max-width:18ch">Quelque chose s'est mal passe</h1>

        <p class="lede" style="max-width:54ch;margin-inline:auto">
            L'incident est enregistre. Si vous aviez une demande en cours,
            l'application reste disponible sur votre téléphone.
        </p>

        <div class="btns centre" style="margin-top:30px">
            <a class="btn or" href="{{ route('accueil') }}">Retour à l'accueil</a>
            <a class="btn creux" href="{{ route('contact') }}">Nous signaler le problème</a>
        </div>
    </div>
</section>

@endsection
