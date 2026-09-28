@extends('layouts.app')

@section('titre', 'Nos services')
@section('description', "Plomberie, électricité, serrurerie, peinture, carrelage, menuiserie, montage de meubles, vitrerie : les dix métiers couverts par Crafterlity, avec le détail des interventions.")

@section('contenu')

<section class="bande" data-anime>
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

        {{-- Deux chiffres, et ils sont vrais : ils sont comptes dans le
             catalogue, pas saisis a la main. Ils defilent a l'arrivee dans
             le champ de vision — un compteur mecanique, pas un effet. --}}
        <p class="releve mono">
            <span data-compteur>{{ count($metiers) }}</span> métiers couverts
            <span class="releve-sep" aria-hidden="true">·</span>
            <span data-compteur>{{ collect($metiers)->sum(fn ($m) => count($m['besoins'])) }}</span> interventions référencées
            <span class="releve-sep" aria-hidden="true">·</span>
            <span data-compteur>{{ collect($metiers)->where('urgence', true)->count() }}</span> métiers en urgence
        </p>
    </div>
</section>

<section class="bande jour serree" data-anime>
    <div class="wrap large">
        <div class="grille trois" data-filtre>
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
