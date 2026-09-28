@extends('layouts.app')

@section('titre', 'Crafterlity')
@section('description', "Décrivez votre besoin, recevez des propositions d'artisans vérifiés autour de vous, suivez l'arrivée du technicien. Plomberie, électricité, serrurerie : intervention d'urgence possible en moins d'une heure.")

@push('schema')
{{--
    Deux blocs de donnees structurees sur cette page.

    Le premier decrit l'application : c'est ce qui permet a une fiche
    d'apparaitre avec son icone, sa categorie et ses boutiques dans un
    resultat de recherche, plutot qu'une simple ligne bleue.

    Le second reprend les questions frequentes. Google les affiche
    directement sous le lien, et les assistants conversationnels y puisent
    leurs reponses — c'est aujourd'hui la seule facon pour une jeune
    plateforme d'etre citee sans budget publicitaire.
--}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'SoftwareApplication',
    'name'     => 'Crafterlity',
    'applicationCategory' => 'BusinessApplication',
    'operatingSystem' => 'iOS 16.4+, Android',
    'url' => route('accueil'),
    'description' => "Mise en relation entre particuliers et artisans vérifiés pour des travaux et dépannages à domicile.",
    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
    'installUrl' => array_values(config('crafterlity.stores')),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => $faq->map(fn ($q) => [
        '@type' => 'Question',
        'name'  => $q['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['r']],
    ])->values()->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('contenu')

{{-- ═══ le premier ecran ═══════════════════════════════════════════ --}}

<section class="hero">

    <div class="wrap heroin">
        <div>
            <h1>Un artisan <span class="or">vérifié</span>,<br>près de chez vous.</h1>

            <p class="hero-lede">
                Décrivez ce qui ne va pas, ajoutez une photo, choisissez votre
                créneau. Les professionnels disponibles autour de votre adresse
                vous répondent avec un prix ferme. Vous choisissez, et vous
                suivez leur arrivée.
            </p>

            {{-- Le bandeau rouge reprend, trait pour trait, celui que le
                 visiteur retrouvera dans l'application. La continuite est
                 le sujet : un site qui ne ressemble pas a son produit
                 oblige l'utilisateur a reapprendre l'interface. --}}
            <div class="hero-urgence">
                <span class="pastille" aria-hidden="true"></span>
                <span>
                    <b>Une urgence ?</b>
                    Plomberie, électricité, serrurerie — intervention possible
                    en moins d'une heure.
                </span>
            </div>

            <div class="btns">
                <a class="btn or" href="{{ route('telecharger') }}">
                    Télécharger l'application
                </a>
                <a class="btn creux" href="{{ route('methode') }}">
                    Comment ça marche
                </a>
            </div>
        </div>

        <div class="hero-visuel">
            {{-- width et height sont declares : ils reservent la place de
                 l'image avant son chargement, et evitent que le texte
                 saute au moment ou elle arrive. --}}
            <img src="{{ asset('images/app-accueil.webp') }}"
                 srcset="{{ asset('images/app-accueil.webp') }} 620w, {{ asset('images/app-accueil@2x.webp') }} 1240w"
                 sizes="(max-width: 920px) 58vw, 330px"
                 width="620" height="1030" fetchpriority="high"
                 alt="L'écran d'accueil de l'application Crafterlity : le logo, la phrase « Trouvez le professionnel dont vous avez besoin tout près de chez vous » et deux boutons, « Voir les professionnels » et « Je suis un professionnel ».">
        </div>
    </div>
</section>

{{-- ═══ les preuves ════════════════════════════════════════════════ --}}

<section aria-label="Ce que garantit Crafterlity">
    <div class="wrap">
        <div class="preuves">
            @foreach($promesses as $p)
                <div class="preuve">
                    <span class="k">{{ $p['cle'] }}</span>
                    <span class="v">{{ $p['valeur'] }}</span>
                    <span class="d">{{ $p['detail'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ les services ═══════════════════════════════════════════════ --}}

<section class="bande">
    <div class="wrap large">
        <x-chapitre rubrique="Les services" titre="Ce pour quoi on nous appelle">
            Dix métiers couverts, du dégât des eaux à six heures du matin à la
            bibliothèque qu'on n'arrive pas à fixer droit. Les interventions
            sont décrites avec les mots des clients, pas avec ceux du bâtiment.
        </x-chapitre>

        <div class="grille trois">
            @foreach($metiers as $metier)
                <x-carte-metier :metier="$metier" />
            @endforeach
        </div>

        <div class="btns" style="margin-top:32px">
            <a class="btn creux" href="{{ route('metiers.index') }}">
                Voir les dix services
            </a>
        </div>
    </div>
</section>

{{-- ═══ la methode ═════════════════════════════════════════════════ --}}

<section class="bande jour">
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-chapitre rubrique="Comment ça marche" titre="Quatre étapes, et aucun appel téléphonique">
                    Le temps que prend, aujourd'hui, le fait d'appeler cinq
                    artisans pour n'en joindre aucun.
                </x-chapitre>

                <x-etapes :etapes="$etapes" />
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-categories.webp') }}"
                     srcset="{{ asset('images/app-categories.webp') }} 620w, {{ asset('images/app-categories@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="962" loading="lazy"
                     alt="L'accueil de l'application : l'adresse d'intervention en haut, un bandeau rouge « Besoin d'aide en urgence ? », puis les catégories les plus recherchées — électricité, plomberie, serrurerie.">
            </div>
        </div>
    </div>
</section>

{{-- ═══ l'urgence ══════════════════════════════════════════════════ --}}

<section class="bande">
    <div class="wrap">
        <div class="urgence-bande">
            <span class="ref">Intervention d'urgence</span>

            <h2 style="margin:18px 0 16px">Quand ça ne peut pas attendre demain</h2>

            <p class="lede" style="max-width:62ch">
                Une fuite qui coule, une porte qui claque, un tableau qui
                disjoncte : la demande part en priorité vers les professionnels
                les plus proches de votre adresse, et chacun annonce son délai
                d'arrivée avant que vous acceptiez.
            </p>

            <div class="urgence-metiers">
                @foreach($urgences as $metier)
                    <a href="{{ route('metiers.show', $metier['slug']) }}">
                        <x-icone :nom="$metier['slug']" :taille="18" />
                        {{ $metier['nom'] }}
                    </a>
                @endforeach
            </div>

            <div class="btns" style="margin-top:30px">
                <a class="btn rouge" href="{{ route('urgence') }}">
                    Comment fonctionne l'urgence
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ le suivi ═══════════════════════════════════════════════════ --}}

<section class="bande jour">
    <div class="wrap">
        <div class="duo inverse">
            <div class="duo-visuel">
                <img src="{{ asset('images/app-suivi.webp') }}"
                     srcset="{{ asset('images/app-suivi.webp') }} 620w, {{ asset('images/app-suivi@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="1032" loading="lazy"
                     alt="Le suivi d'une intervention : une carte de Lyon, la mention « Louis est en route vers votre adresse », une arrivée estimée dans trois minutes, et la fiche du technicien avec sa note et son nombre de missions.">
            </div>

            <div class="duo-texte">
                <x-chapitre rubrique="Pendant l'intervention" titre="Vous savez qui vient, et quand">
                    C'est la différence entre une plage horaire de quatre
                    heures et une adresse qui se rapproche sur une carte.
                </x-chapitre>

                <ul class="puces">
                    <li>
                        <x-icone nom="position" :taille="19" />
                        <span>Le trajet du professionnel s'affiche en direct dès qu'il indique être en route.</span>
                    </li>
                    <li>
                        <x-icone nom="horloge" :taille="19" />
                        <span>L'heure d'arrivée estimée est recalculée pendant le déplacement.</span>
                    </li>
                    <li>
                        <x-icone nom="etoile" :taille="19" />
                        <span>Vous voyez son nom, son entreprise, sa note et le nombre de missions qu'il a déjà réalisées.</span>
                    </li>
                    <li>
                        <x-icone nom="courriel" :taille="19" />
                        <span>Une messagerie intégrée, pour préciser un code d'entrée ou un étage sans donner votre numéro.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ═══ les artisans ═══════════════════════════════════════════════ --}}

<section class="bande">
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-chapitre rubrique="Vous êtes artisan" titre="Des missions, pas des contacts revendus">
                    Pas d'abonnement, pas de fichier de prospects acheté cinq
                    fois. Vous recevez des demandes réelles, dans votre zone,
                    et vous répondez à celles qui vous intéressent.
                </x-chapitre>

                <ul class="puces">
                    <li>
                        <x-icone nom="bouclier" :taille="19" />
                        <span>Votre SIRET est vérifié auprès de l'INSEE : c'est ce qui vous distingue d'une annonce sans identité.</span>
                    </li>
                    <li>
                        <x-icone nom="euro" :taille="19" />
                        <span>Vous annoncez votre prix et votre délai. Pas d'enchère inversée.</span>
                    </li>
                    <li>
                        <x-icone nom="carte" :taille="19" />
                        <span>Vous choisissez votre rayon d'intervention et vos créneaux.</span>
                    </li>
                    <li>
                        <x-icone nom="coche" :taille="19" />
                        <span>Le versement part une fois la mission terminée, vers l'IBAN de votre entreprise.</span>
                    </li>
                </ul>

                <div class="btns" style="margin-top:30px">
                    <a class="btn or" href="{{ route('artisans') }}">
                        L'espace artisan
                    </a>
                </div>
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-urgence.webp') }}"
                     srcset="{{ asset('images/app-urgence.webp') }} 620w, {{ asset('images/app-urgence@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="880" loading="lazy"
                     alt="Le panneau « Obtenir une intervention d'urgence » de l'application, avec trois entrées : urgence électrique, urgence de plomberie, urgence en serrurerie.">
            </div>
        </div>
    </div>
</section>

{{-- ═══ les questions ══════════════════════════════════════════════ --}}

<section class="bande jour">
    <div class="wrap">
        <x-chapitre rubrique="Questions fréquentes" titre="Ce qu'on nous demande le plus souvent" centre>
            Les réponses aux questions des particuliers. Les artisans
            trouveront les leurs dans l'espace qui leur est réservé.
        </x-chapitre>

        <div style="max-width:880px;margin-inline:auto">
            <x-faq :questions="$faq" :etiquettes="false" />

            <div class="btns centre" style="margin-top:28px">
                <a class="btn creux" href="{{ route('questions') }}">
                    Toutes les questions
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ═══ l'appel final ══════════════════════════════════════════════ --}}

<section class="bande" style="overflow:hidden;position:relative">

    <div class="wrap" style="position:relative;z-index:1;text-align:center">
        <span class="ref">Disponible sur iOS et Android</span>

        <h2 style="margin:20px auto 18px;max-width:18ch">
            Le prochain problème, vous saurez qui appeler.
        </h2>

        <p class="lede" style="max-width:56ch;margin-inline:auto">
            Créer un compte prend moins d'une minute. Publier une demande
            n'engage à rien et ne coûte rien : vous ne payez que
            l'intervention que vous avez acceptée.
        </p>

        <div style="display:flex;justify-content:center;margin-top:32px">
            <x-stores />
        </div>
    </div>
</section>

@endsection
