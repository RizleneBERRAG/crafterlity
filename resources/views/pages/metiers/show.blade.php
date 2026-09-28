@extends('layouts.app')

@section('titre', $metier['requete'].' — '.$metier['nom'])
@section('description', $metier['resume'].' Décrivez votre besoin sur Crafterlity, recevez des propositions de professionnels vérifiés autour de vous.')

@push('schema')
{{--
    Le service decrit en donnees structurees, avec sa zone. C'est ce qui
    permet a un moteur de rattacher « plombier » a « Lyon » sans que la
    phrase « plombier a Lyon » ait a etre repetee douze fois dans le texte,
    procede qui date d'il y a quinze ans et qui rend une page illisible.
--}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'Service',
    'name'     => $metier['nom'],
    'serviceType' => $metier['requete'],
    'description' => $metier['resume'],
    'provider' => ['@type' => 'Organization', 'name' => 'Crafterlity', 'url' => route('accueil')],
    'areaServed' => array_map(
        fn ($ville) => ['@type' => 'City', 'name' => $ville],
        config('parcours.zone')
    ),
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name'  => 'Interventions '.strtolower($metier['nom']),
        'itemListElement' => array_map(
            fn ($besoin) => ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => $besoin]],
            $metier['besoins']
        ),
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('contenu')

<section class="bande">

    <div class="wrap" style="position:relative;z-index:1">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <a href="{{ route('metiers.index') }}">Services</a>
            <span aria-hidden="true">/</span>
            <span>{{ $metier['nom'] }}</span>
        </nav>

        <div style="display:flex;align-items:center;gap:18px;margin-bottom:22px">
            <span class="icone" style="width:58px;height:58px;border-radius:17px;
                display:grid;place-items:center;color:var(--or);
                background:rgba(251,201,114,.11);border:1px solid rgba(251,201,114,.2)">
                <x-icone :nom="$metier['slug']" :taille="28" />
            </span>

            @if($metier['urgence'])
                <span class="fanion" style="position:static">Intervention d'urgence</span>
            @endif
        </div>

        <h1 style="max-width:16ch">{{ $metier['requete'] }} près de chez vous</h1>

        <p class="hero-lede" style="margin-top:22px">{{ $metier['resume'] }}</p>

        <div class="btns">
            <a class="btn or" href="{{ route('telecharger') }}">Décrire mon besoin</a>
            @if($metier['urgence'])
                <a class="btn creux" href="{{ route('urgence') }}">C'est une urgence</a>
            @endif
        </div>
    </div>
</section>

<section class="bande jour">
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-chapitre rubrique="Les interventions"
                            titre="Ce que prennent en charge les {{ $metier['pluriel'] }} de Crafterlity"
                            niveau="h2">
                    Si votre situation ressemble à l'une de celles-ci, un
                    professionnel peut la traiter. Sinon, décrivez-la quand
                    même : la demande part, et elle ne vous engage à rien.
                </x-chapitre>

                <ul class="puces">
                    @foreach($metier['besoins'] as $besoin)
                        <li>
                            <x-icone nom="coche" :taille="19" />
                            <span>{{ $besoin }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-categories.webp') }}"
                     srcset="{{ asset('images/app-categories.webp') }} 620w, {{ asset('images/app-categories@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="962" loading="lazy"
                     alt="L'application Crafterlity : les catégories d'intervention les plus recherchées.">
            </div>
        </div>
    </div>
</section>

<section class="bande">
    <div class="wrap">
        <x-chapitre rubrique="Comment ça se passe"
                    titre="De la demande à l'intervention" centre>
            Le parcours est le même pour tous les métiers.
        </x-chapitre>

        <div style="max-width:820px;margin-inline:auto">
            <x-etapes :etapes="config('parcours.client')" />
        </div>
    </div>
</section>

<section class="bande jour serree">
    <div class="wrap large">
        <x-chapitre rubrique="Les autres services" titre="On intervient aussi pour" centre />

        <div class="grille trois">
            @foreach($voisins as $voisin)
                <x-carte-metier :metier="$voisin" />
            @endforeach
        </div>

        <div class="btns centre" style="margin-top:30px">
            <a class="btn creux" href="{{ route('metiers.index') }}">Tous les services</a>
        </div>
    </div>
</section>

@endsection
