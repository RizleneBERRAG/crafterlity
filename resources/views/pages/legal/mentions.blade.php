@extends('layouts.app')

@section('titre', 'Mentions légales')
@section('description', "Éditeur, directrice de la publication, hébergeur, propriété intellectuelle et médiation : les informations légales du site crafterlity.com.")

@section('contenu')

@php $s = config('crafterlity.societe'); @endphp

<section class="bande jour">
    <div class="wrap etroit">

        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Mentions légales</span>
        </nav>

        <article class="legal">
            <h1 style="font-size:clamp(2rem,4.2vw,3.2rem)">Mentions légales</h1>
            <p class="maj">Dernière mise à jour : {{ $maj }}</p>

            <h2>1. Éditeur du site</h2>

            <dl class="identite">
                <dt>Dénomination</dt><dd>{{ $s['raison'] }}</dd>
                <dt>Forme juridique</dt><dd>{{ $s['forme'] }} (société par actions simplifiée)</dd>
                <dt>Capital social</dt><dd>{{ $s['capital'] }}</dd>
                <dt>Siège social</dt><dd>{{ $s['adresse'] }}, {{ $s['code_postal'] }} {{ $s['ville'] }}, {{ $s['pays'] }}</dd>
                <dt>SIREN</dt><dd>{{ $s['siren'] }}</dd>
                <dt>SIRET (siège)</dt><dd>{{ $s['siret'] }}</dd>
                <dt>Immatriculation</dt><dd>{{ $s['rcs'] }} {{ $s['siren'] }}</dd>
                <dt>TVA intracommunautaire</dt><dd>{{ $s['tva'] }}</dd>
                <dt>Courriel</dt><dd><a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a></dd>
                <dt>Téléphone</dt><dd><a href="tel:+33767914587">{{ $s['telephone'] }}</a></dd>
            </dl>

            <h2>2. Directrice de la publication</h2>
            <p>
                {{ $s['publication'] }}, présidente de {{ $s['raison'] }}.
            </p>

            <h2>3. Hébergement</h2>
            {{--
                Obligation de l'article 6-III de la LCEN : le nom, la
                denomination et l'adresse de l'hebergeur doivent figurer sur
                le site. La donnee appartient a Crafterlity ; l'inventer
                serait publier une information fausse sur la page dont la
                fonction est precisement d'etre exacte.
            --}}
            <p>
                <strong>À compléter avant mise en ligne :</strong> nom ou
                dénomination sociale, adresse et numéro de téléphone de
                l'hébergeur du site, conformément à l'article 6-III de la loi
                n&deg; 2004-575 du 21 juin 2004 pour la confiance dans
                l'économie numérique.
            </p>

            <h2>4. Nature du service</h2>
            <p>
                Crafterlity édite une application mobile de mise en relation
                entre des particuliers souhaitant faire réaliser une
                intervention à domicile et des professionnels indépendants
                proposant leurs services.
            </p>
            <p>
                Crafterlity n'est ni l'employeur ni le mandataire des
                professionnels inscrits, et ne réalisé aucune prestation de
                travaux. Le contrat de prestation est conclu directement entre
                le client et le professionnel qu'il a choisi. Chaque
                professionnel demeure seul responsable de l'exécution de son
                intervention, de sa conformité aux règles de son métier, de
                ses qualifications et de ses assurances.
            </p>

            <h2>5. Propriété intellectuelle</h2>
            <p>
                La marque Crafterlity, le logo, la charte graphique,
                l'architecture du site, ses textes et l'application mobile
                sont protégés par le droit de la propriété intellectuelle et
                demeurent la propriété de {{ $s['raison'] }} ou de ses
                partenaires.
            </p>
            <p>
                Toute reproduction, représentation, adaptation ou exploitation,
                totale ou partielle, par quelque procédé que ce soit et sur
                quelque support que ce soit, est interdite sans autorisation
                écrite préalable, hors courte citation avec mention de la
                source et lien vers la page d'origine.
            </p>

            <h2>6. Liens</h2>
            <p>
                Le site renvoie vers l'App Store d'Apple et Google Play, ainsi
                que vers des services publics d'urgence. Crafterlity n'exerce
                aucun contrôle sur le contenu de ces sites et ne saurait en
                être tenue responsable.
            </p>

            <h2>7. Données personnelles</h2>
            <p>
                Le traitement des données personnelles est décrit dans la
                <a href="{{ route('legal.confidentialite') }}">politique de confidentialité</a>.
                Vous disposez d'un droit d'accès, de rectification,
                d'effacement, de limitation, d'opposition et de portabilité,
                exerçables à <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a>.
            </p>
            <p>
                Vous pouvez introduire une réclamation auprès de la Commission
                nationale de l'informatique et des libertés (CNIL) :
                3 place de Fontenoy, TSA 80715, 75334 Paris Cedex 07 —
                <a href="https://www.cnil.fr/" rel="noopener">www.cnil.fr</a>.
            </p>

            <h2>8. Médiation de la consommation</h2>
            {{--
                Articles L.612-1 et suivants du code de la consommation : tout
                professionnel proposant ses services a des consommateurs doit
                designer nommement un mediateur et publier ses coordonnees.
                C'est une obligation, pas une option — et le mediateur se
                choisit, il ne s'invente pas.
            --}}
            <p>
                Conformément aux articles L.612-1 et suivants du code de la
                consommation, le consommateur peut recourir gratuitement à un
                médiateur de la consommation en vue de la résolution amiable
                d'un litige qui l'oppose à un professionnel.
            </p>
            <p>
                <strong>À compléter avant mise en ligne :</strong> nom,
                coordonnées postales et adresse du site du médiateur de la
                consommation désigné par {{ $s['raison'] }}.
            </p>
            <p>
                La Commission européenne met par ailleurs à disposition une
                plateforme de règlement en ligne des litiges, accessible à
                l'adresse
                <a href="https://ec.europa.eu/consumers/odr" rel="noopener">ec.europa.eu/consumers/odr</a>.
            </p>

            <h2>9. Droit applicable</h2>
            <p>
                Le présent site est soumis au droit français. En cas de litige,
                et à défaut de résolution amiable, les tribunaux français sont
                compétents, sous réserve des règles protectrices applicables
                aux consommateurs.
            </p>
        </article>

    </div>
</section>

@endsection
