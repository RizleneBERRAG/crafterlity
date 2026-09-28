@extends('layouts.app')

@section('titre', 'Comment ça marche')
@section('description', "De la demande au paiement : les quatre étapes d'une intervention Crafterlity, ce que vous voyez, ce que vous payez, et ce que vous pouvez refuser.")

@push('schema')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'HowTo',
    'name'     => 'Trouver un artisan avec Crafterlity',
    'description' => "Publier une demande d'intervention et choisir un professionnel verifie.",
    'totalTime' => 'PT2M',
    'step' => collect(config('parcours.client'))->values()->map(fn ($e, $i) => [
        '@type'    => 'HowToStep',
        'position' => $i + 1,
        'name'     => $e['titre'],
        'text'     => $e['texte'],
    ])->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('contenu')

<section class="bande" data-anime>

    <div class="wrap" style="position:relative;z-index:1">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Comment ça marche</span>
        </nav>

        <x-chapitre rubrique="Le parcours"
                    titre="Quatre étapes, et aucun appel téléphonique"
                    niveau="h1">
            Le temps qu'il faut aujourd'hui pour appeler cinq artisans et
            n'en joindre aucun, vous l'avez déjà passe à décrire votre besoin
            et à recevoir trois propositions fermes.
        </x-chapitre>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-etapes :etapes="$etapes" />
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-suivi.webp') }}"
                     srcset="{{ asset('images/app-suivi.webp') }} 620w, {{ asset('images/app-suivi@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="1032" loading="lazy"
                     alt="Le suivi d'une intervention dans l'application : la carte, l'heure d'arrivée estimée et la fiche du technicien.">
            </div>
        </div>
    </div>
</section>

{{-- Ce que le visiteur veut vraiment savoir et qu'aucune plateforme
     n'ecrit : ou est le piege. Le dire en premier desamorce la mefiance
     mieux que trois paragraphes de promesses. --}}
<section class="bande" data-anime>
    <div class="wrap">
        <x-chapitre rubrique="Sans mauvaise surprise" titre="Ce que vous payez, et ce que vous ne payez pas">
            La réputation du dépannage à domicile s'est faite sur des
            factures qui triplent une fois l'artisan sur le palier. Voila
            comment Crafterlity s'y prend.
        </x-chapitre>

        <div class="grille deux">
            <div class="carte">
                <span class="icone"><x-icone nom="euro" :taille="23" /></span>
                <h3>Le prix est annoncé avant</h3>
                <p>
                    Un professionnel ne peut pas répondre sans chiffrer. Vous
                    comparez des montants fermes, pas des « à partir de ».
                    Aucun déplacement n'est déclenché avant que vous ayez
                    accepte une offre.
                </p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="document" :taille="23" /></span>
                <h3>Un supplément se refuse</h3>
                <p>
                    Si le professionnel découvre sur place un travail plus
                    important que ce que décrivaient votre message et vos
                    photos, il doit vous proposer un nouveau montant. Vous
                    restez libre de le refuser et d'arreter la.
                </p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="bouclier" :taille="23" /></span>
                <h3>Aucune carte sur le palier</h3>
                <p>
                    Le règlement passe par l'application, via Stripe. Vos
                    données bancaires ne transitent pas par les serveurs de
                    Crafterlity, et le professionnel n'a jamais votre numéro
                    de carte sous les yeux.
                </p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="sablier" :taille="23" /></span>
                <h3>Publier ne coûte rien</h3>
                <p>
                    Créer un compte, décrire un besoin, recevoir des offres et
                    les refuser toutes : tout cela est gratuit. Si aucune
                    proposition ne vous convient, votre demande expire, et
                    c'est tout.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap">
        <x-chapitre rubrique="Les services" titre="Pour quels travaux" centre>
            Dix métiers, des plus urgents aux plus tranquilles.
        </x-chapitre>

        <div class="jetons" style="justify-content:center;max-width:860px;margin-inline:auto">
            @foreach($metiers as $metier)
                <a class="jeton" href="{{ route('metiers.show', $metier['slug']) }}">{{ $metier['nom'] }}</a>
            @endforeach
        </div>
    </div>
</section>

<section class="bande jour serree" style="padding-top:0">
    <div class="wrap">
        <x-chapitre rubrique="Questions fréquentes" titre="Ce qu'on nous demande" centre />

        <div style="max-width:880px;margin-inline:auto">
            <x-faq :questions="$faq" :etiquettes="false" />
        </div>
    </div>
</section>

<section class="bande" style="overflow:hidden;position:relative">

    <div class="wrap" style="position:relative;z-index:1;text-align:center">
        <h2 style="margin-inline:auto;max-width:20ch">Essayez sur votre prochain problème</h2>

        <div style="display:flex;justify-content:center;margin-top:30px">
            <x-stores />
        </div>
    </div>
</section>

@endsection
