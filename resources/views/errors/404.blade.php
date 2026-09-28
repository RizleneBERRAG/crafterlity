@extends('layouts.app')

@section('titre', 'Page introuvable')

@section('contenu')

{{--
    Une page 404 qui se contente d'annoncer l'erreur laisse le visiteur
    sans porte de sortie. Celle-ci reoriente vers ce qu'il cherchait
    probablement : un metier, ou l'application.
--}}

<section class="bande" style="overflow:hidden;position:relative;min-height:56vh;display:grid;align-items:center">

    <div class="wrap" style="position:relative;z-index:1;text-align:center">
        <span class="ref">Erreur 404</span>

        <h1 style="margin:20px auto 18px;max-width:16ch">Cette page n'existe pas</h1>

        <p class="lede" style="max-width:52ch;margin-inline:auto">
            Le lien est peut-être ancien, ou l'adresse mal recopiée. Voici par
            ou reprendre.
        </p>

        <div class="btns centre" style="margin-top:30px">
            <a class="btn or" href="{{ route('accueil') }}">Retour à l'accueil</a>
            <a class="btn creux" href="{{ route('metiers.index') }}">Voir les services</a>
        </div>

        <div class="jetons" style="justify-content:center;margin-top:38px;max-width:760px;margin-inline:auto">
            @foreach(collect(config('metiers'))->take(6) as $metier)
                <a class="jeton" href="{{ route('metiers.show', $metier['slug']) }}">{{ $metier['nom'] }}</a>
            @endforeach
        </div>
    </div>
</section>

@endsection
