@extends('layouts.app')

@section('titre', 'Nos services')
@section('description', "Plomberie, électricité, serrurerie, peinture, carrelage, menuiserie, montage de meubles, vitrerie : les dix métiers couverts par Crafterlity, avec le détail des interventions.")

@section('contenu')

<section class="bande">
    <div class="wrap">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Services</span>
        </nav>

        <x-chapitre rubrique="Les services" titre="Dix métiers, une seule application" niveau="h1">
            Chaque métier a sa page : vous y trouverez la liste des
            interventions que les professionnels de Crafterlity prennent en
            charge, décrites avec les mots qu'on emploie quand on appelle,
            pas avec ceux d'un devis.
        </x-chapitre>
    </div>
</section>

<section class="bande jour serree">
    <div class="wrap large">
        <div class="grille trois">
            @foreach($metiers as $metier)
                <x-carte-metier :metier="$metier" />
            @endforeach
        </div>

        {{-- Le metier absent de la liste est la question qu'on se pose en
             arrivant sur cette page. Y repondre ici evite un depart. --}}
        <div class="encart" style="margin-top:clamp(36px,4.5vw,60px)">
            <div class="duo">
                <div class="duo-texte">
                    <span class="ref">Votre besoin n'est pas dans la liste</span>
                    <h2 style="margin:18px 0 16px">Décrivez-le quand même</h2>
                    <p class="lede">
                        La catégorie « petits travaux » reçoit tout ce qui ne
                        rentre nulle part ailleurs — et c'est souvent ce dont
                        on à besoin. Si personne ne peut intervenir, votre
                        demande reste sans suite et ne vous coûte rien.
                    </p>
                </div>

                <div style="display:flex;align-items:center">
                    <a class="btn or" href="{{ route('telecharger') }}">
                        Télécharger l'application
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
