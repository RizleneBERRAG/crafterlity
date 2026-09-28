@extends('layouts.app')

@section('titre', 'Vous êtes artisan')
@section('description', "Recevez des missions réelles autour de vous, annoncez votre prix, soyez payé à la fin de l'intervention. Sans abonnement, sans contact revendu, sans enchère inversée.")

@push('schema')
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

<section class="hero" data-anime>

    <div class="wrap heroin">
        <div>
            <nav class="ariane" aria-label="Fil d'Ariane">
                <a href="{{ route('accueil') }}">Accueil</a>
                <span aria-hidden="true">/</span>
                <span>Vous êtes artisan</span>
            </nav>

            <h1>Des missions.<br>Pas des <span class="or">contacts</span> revendus.</h1>

            <p class="hero-lede">
                Vous connaissez le système : on achète un lot de coordonnées,
                on appelle, et on découvre que quatre confrères ont déjà
                téléphone le matin même. Crafterlity fonctionne autrement —
                vous répondez à une demande réelle, avec votre prix, et vous
                ne payez que si elle aboutit.
            </p>

            <div class="btns">
                <a class="btn or" href="{{ route('telecharger') }}">Créer mon profil artisan</a>
                <a class="btn creux" href="#conditions">Ce que ça coûte</a>
            </div>
        </div>

        <div class="hero-visuel">
            <img src="{{ asset('images/app-accueil.webp') }}"
                 srcset="{{ asset('images/app-accueil.webp') }} 620w, {{ asset('images/app-accueil@2x.webp') }} 1240w"
                 sizes="(max-width: 920px) 58vw, 330px"
                 width="620" height="1030" loading="lazy"
                 alt="L'écran d'accueil de l'application, avec l'entrée « Je suis un professionnel ».">
        </div>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap">
        <x-chapitre rubrique="Votre parcours" titre="De l'inscription au virement">
            Quatre étapes, dont une seule vous demande un effort : la
            première.
        </x-chapitre>

        <div style="max-width:880px">
            <x-etapes :etapes="$etapes" />
        </div>
    </div>
</section>

<section class="bande" id="conditions">
    <div class="wrap">
        <x-chapitre rubrique="Les conditions" titre="Ce que ça coûte, dit simplement">
            Une plateforme qui ne veut pas parler de sa commission à
            généralement une bonne raison. Voici la notre, en clair.
        </x-chapitre>

        <div class="grille trois">
            <div class="carte">
                <span class="icone"><x-icone nom="euro" :taille="23" /></span>
                <h3>Aucun abonnement</h3>
                <p>
                    L'inscription, la vérification de votre entreprise, la
                    réception des missions et l'envoi de vos offres sont
                    gratuits. Un mois sans mission est un mois sans facture.
                </p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="coche" :taille="23" /></span>
                <h3>Commission sur mission réalisée</h3>
                <p>
                    Une commission n'est prélevée que sur les interventions
                    effectivement réalisées et réglées via l'application. Un
                    devis refuse ne vous coûte rien.
                </p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="bouclier" :taille="23" /></span>
                <h3>Pas de contact revendu</h3>
                <p>
                    Une demande n'est pas vendue à cinq artisans qui se
                    téléphonent dessus. Le client reçoit des offres et en
                    choisit une : celle qui est retenue est la seule facturée.
                </p>
            </div>
        </div>

        {{-- Le taux exact appartient a Crafterlity : l'inventer sur une
             maquette serait afficher un chiffre faux sur la page qui
             engage le plus. Le cadre est pose, le nombre se remplit. --}}
        <p class="note" style="margin-top:22px;max-width:70ch">
            Le taux de commission applicable est indique dans l'application
            avant l'envoi de votre première offre, et rappele dans les
            conditions générales.
        </p>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap">
        <div class="duo inverse">
            <div class="duo-visuel">
                <img src="{{ asset('images/app-suivi.webp') }}"
                     srcset="{{ asset('images/app-suivi.webp') }} 620w, {{ asset('images/app-suivi@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="1032" loading="lazy"
                     alt="La fiche d'un technicien dans l'application : son nom, sa spécialité, sa note et son nombre de missions réalisées.">
            </div>

            <div class="duo-texte">
                <x-chapitre rubrique="La vérification"
                            titre="Ce qui vous distingue d'une annoncé sans nom">
                    C'est le seul argument qui compte face à un client qui
                    hésite à ouvrir sa porte.
                </x-chapitre>

                <ul class="puces">
                    <li>
                        <x-icone nom="document" :taille="19" />
                        <span>Votre SIRET est vérifié auprès des services de l'INSEE : raison sociale, forme juridique, date d'immatriculation.</span>
                    </li>
                    <li>
                        <x-icone nom="bouclier" :taille="19" />
                        <span>L'identité du représentant légal est contrôlée par Stripe, dans le cadre de l'ouverture de votre compte de versement.</span>
                    </li>
                    <li>
                        <x-icone nom="etoile" :taille="19" />
                        <span>Vos missions réalisées et vos avis s'accumulent sur votre profil : au bout de quelques chantiers, ce sont eux qui vendent.</span>
                    </li>
                    <li>
                        <x-icone nom="position" :taille="19" />
                        <span>Le client voit votre distance et votre délai d'arrivée estimé — l'artisan du quartier reprend l'avantage qu'il mérite.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="bande" data-anime>
    <div class="wrap large">
        <x-chapitre rubrique="Les métiers recherches" titre="Les spécialités les plus demandées" centre>
            Vous en exercez plusieurs ? Vous les cochez toutes, et vous
            recevez les missions correspondantes.
        </x-chapitre>

        <div class="jetons" style="justify-content:center;max-width:860px;margin-inline:auto">
            @foreach($metiers as $metier)
                <a class="jeton" href="{{ route('metiers.show', $metier['slug']) }}">{{ $metier['nom'] }}</a>
            @endforeach
        </div>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap">
        <x-chapitre rubrique="Questions d'artisans" titre="Ce que les professionnels nous demandent" centre />

        <div style="max-width:880px;margin-inline:auto">
            <x-faq :questions="$faq" :etiquettes="false" />
        </div>

        <div class="btns centre" style="margin-top:34px">
            <a class="btn or" href="{{ route('telecharger') }}">Créer mon profil artisan</a>
            <a class="btn creux" href="{{ route('contact') }}">Poser une question</a>
        </div>
    </div>
</section>

@endsection
