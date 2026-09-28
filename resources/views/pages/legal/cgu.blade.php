@extends('layouts.app')

@section('titre', "Conditions générales")
@section('description', "Conditions générales d'utilisation et de service de la plateforme Crafterlity : role de la plateforme, obligations des clients et des professionnels, paiement, annulation, rétractation et responsabilités.")

@section('contenu')

@php $s = config('crafterlity.societe'); @endphp

<section class="bande jour">
    <div class="wrap etroit">

        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Conditions générales</span>
        </nav>

        <article class="legal">
            <h1 style="font-size:clamp(2rem,4.2vw,3.2rem)">Conditions générales</h1>
            <p class="maj">Dernière mise à jour : {{ $maj }}</p>

            {{--
                Cette page est un projet de travail, pas un texte valide.

                Des conditions generales engagent la societe devant un juge :
                celles-ci couvrent les points qu'une plateforme de mise en
                relation avec paiement DOIT traiter, dans l'ordre ou un
                lecteur les cherche, mais elles doivent etre relues et
                arretees par un avocat avant publication. Le dire ici plutot
                que de laisser croire le contraire fait partie du travail.
            --}}
            <div class="message ko" style="margin-bottom:8px">
                <x-icone nom="document" :taille="20" />
                <span>
                    <strong>Projet à faire valider.</strong>
                    Ce texte couvre les points qu'une plateforme de mise en
                    relation avec encaissement doit traiter. Il doit être relu
                    et arrete par un conseil juridique avant mise en ligne :
                    les montants, délais et coordonnées du médiateur y sont
                    signalés comme restant à compléter.
                </span>
            </div>

            <h2>1. Objet</h2>
            <p>
                Les présentes conditions regissent l'accès et l'utilisation de
                l'application mobile et du site Crafterlity, édités par
                {{ $s['raison'] }}, {{ $s['forme'] }} au capital de
                {{ $s['capital'] }}, immatriculée sous le numéro
                {{ $s['siren'] }} au {{ $s['rcs'] }}, dont le siège est situé
                {{ $s['adresse'] }}, {{ $s['code_postal'] }} {{ $s['ville'] }}.
            </p>
            <p>
                Toute création de compte emporte acceptation sans réserve des
                présentes conditions.
            </p>

            <h2>2. Role de la plateforme</h2>
            <p>
                Crafterlity exploite une plateforme de mise en relation. Elle
                ne réalisé aucune prestation de travaux, n'emploie pas les
                professionnels inscrits et n'agit pas en leur nom.
            </p>
            <p>
                Le contrat de prestation est conclu directement entre le
                <strong>client</strong> et le <strong>professionnel</strong>
                retenu. Crafterlity n'est pas partie à ce contrat. Elle
                intervient uniquement pour :
            </p>
            <ul>
                <li>permettre la publication d'une demande d'intervention ;</li>
                <li>transmettre cette demande aux professionnels éligibles ;</li>
                <li>mettre à disposition les outils d'échange, de suivi et de paiement ;</li>
                <li>vérifier l'existence et l'immatriculation des entreprises inscrites.</li>
            </ul>

            <h2>3. Inscription</h2>

            <h3>3.1 Clients</h3>
            <p>
                L'inscription est réservée aux personnes physiques majeures
                disposant de la capacité juridique. Elle est gratuite. Le
                compte est personnel : vous répondez des demandes publiées
                depuis celui-ci.
            </p>

            <h3>3.2 Professionnels</h3>
            <p>
                L'inscription en qualité de professionnel suppose une
                entreprise immatriculée et un numéro SIRET actif. Les
                informations déclarées sont vérifiées auprès des services de
                l'INSEE, et l'identité du représentant légal est contrôlée par
                le prestataire de paiement dans le cadre de l'ouverture du
                compte de versement.
            </p>
            <p>
                Le professionnel garantit disposer des qualifications, des
                autorisations et des assurances exigées pour l'exercice de son
                activité, notamment l'assurance de responsabilité civile
                professionnelle et, lorsque son activité y est soumise,
                l'assurance décennale. Il s'engage à les maintenir pendant
                toute la durée de son inscription et à en justifier sur
                demande.
            </p>

            <h2>4. Publication d'une demande et formation du contrat</h2>
            <p>
                Le client décrit son besoin, la date ou le créneau souhaité et
                l'adresse d'intervention. Les professionnels éligibles peuvent
                lui adresser une offre comportant un prix et un délai
                d'intervention.
            </p>
            <p>
                Le contrat est forme au moment ou le client accepte une offre.
                Le prix accepte est ferme. Si le professionnel constate sur
                place que la prestation diffère substantiellement de ce qui
                était décrit, il doit en informer le client et lui soumettre une
                nouvelle offre, que celui-ci reste libre de refuser.
            </p>

            <h2>5. Prix, paiement et versement</h2>
            <p>
                L'utilisation de la plateforme est gratuite pour les clients.
                Ceux-ci ne règlent que le prix de l'intervention qu'ils ont
                acceptée.
            </p>
            <p>
                Les paiements sont traités par Stripe. Les données de carte
                bancaire sont collectées directement par ce prestataire et ne
                sont pas conservées par Crafterlity. Le versement au
                professionnel est déclenché une fois la mission marquée comme
                terminée, sur le compte associé à l'IBAN de son entreprise.
            </p>
            <p>
                <strong>À compléter :</strong> taux de commission applicable
                aux professionnels, assiette de calcul, éventuels frais de
                service supportés par le client, et délai de versement.
            </p>

            <h2>6. Annulation</h2>
            <p>
                Tant qu'aucune offre n'a été acceptée, le client peut retirer
                sa demande à tout moment et sans frais.
            </p>
            <p>
                Après acceptation, l'annulation s'effectue depuis la messagerie
                de l'application. Un déplacement déjà engagé peut donner lieu à
                des frais.
            </p>
            <p>
                <strong>À compléter :</strong> barème des frais d'annulation
                selon le stade de la mission, et conséquences d'une annulation
                répétée du fait d'un professionnel.
            </p>

            <h2>7. Droit de rétractation</h2>
            {{--
                Articles L.221-18 et L.221-25 du code de la consommation. Le
                point qui compte en pratique : une intervention d'urgence
                executee avant la fin des quatorze jours suppose une demande
                expresse du consommateur, faute de quoi le professionnel
                s'expose a devoir rembourser une prestation deja realisee.
            --}}
            <p>
                Le client consommateur dispose d'un délai de quatorze jours
                pour se rétracter d'un contrat conclu à distance, conformément
                à l'article L.221-18 du code de la consommation.
            </p>
            <p>
                Lorsque l'intervention doit être exécutée avant l'expiration de
                ce délai — ce qui est le cas de toute intervention d'urgence —
                le client en fait la demande expresse. Il reconnait alors que,
                si la prestation est pleinement exécutée avant la fin du délai,
                il perd son droit de rétractation ; si elle n'est que
                partiellement exécutée, il reste redevable du montant
                correspondant à ce qui a été fourni.
            </p>

            <h2>8. Obligations des utilisateurs</h2>
            <p>Chaque utilisateur s'engage à :</p>
            <ul>
                <li>fournir des informations exactes et les tenir à jour ;</li>
                <li>n'utiliser la plateforme qu'à des fins licites ;</li>
                <li>ne pas contourner le système de paiement pour une mission née sur la plateforme ;</li>
                <li>ne publier ni contenu illicite, ni photographie de tiers sans leur accord ;</li>
                <li>respecter les autres utilisateurs dans les échanges.</li>
            </ul>

            <h2>9. Avis</h2>
            <p>
                Les avis émanent d'utilisateurs ayant effectivement réalisé une
                mission via la plateforme. Un avis peut être retire s'il est
                injurieux, diffamatoire, sans rapport avec la prestation ou
                manifestement frauduleux. Crafterlity ne modifie pas le
                contenu des avis publiés.
            </p>

            <h2>10. Responsabilité</h2>
            <p>
                Crafterlity est tenue d'une obligation de moyens au titre du
                fonctionnement de la plateforme. Elle ne garantit ni la
                disponibilité d'un professionnel à un instant donne, ni un
                délai d'intervention, ceux-ci dépendant des professionnels
                réellement disponibles à proximité.
            </p>
            <p>
                La qualité de l'intervention, sa conformité aux règles de l'art
                et les dommages qu'elle pourrait causer relèvent de la
                responsabilité du professionnel qui l'a réalisée et de ses
                assurances.
            </p>
            <p>
                Crafterlity ne saurait être tenue responsable des dommages
                résultant d'une information inexacte fournie par un
                utilisateur, ni d'une interruption imputable au réseau, à
                l'hébergeur ou à un prestataire tiers.
            </p>

            <h2>11. Suspension et résiliation</h2>
            <p>
                Un compte peut être suspendu ou ferme en cas de manquement aux
                présentes conditions, de fraude, d'usurpation d'identité ou de
                mise en danger d'autres utilisateurs. L'utilisateur peut à tout
                moment demander la suppression de son compte selon les
                modalités indiquées dans la
                <a href="{{ route('legal.confidentialite') }}">politique de confidentialité</a>.
            </p>

            <h2>12. Obligations déclaratives</h2>
            {{--
                Article 242 bis du code general des impots : une plateforme
                qui met en relation doit informer ses utilisateurs de leurs
                obligations fiscales et sociales, et leur adresser un
                recapitulatif annuel des sommes percues. Oubli frequent, et
                sanctionne.
            --}}
            <p>
                Conformément à l'article 242 bis du code général des impôts,
                Crafterlity informe les professionnels que les sommes perçues
                via la plateforme sont soumises aux obligations fiscales et
                sociales attachées à leur activité, et leur adresse un
                récapitulatif annuel des opérations réalisées.
            </p>

            <h2>13. Modification</h2>
            <p>
                Les présentes conditions peuvent être modifiées. Les
                utilisateurs en sont informes dans l'application ; la poursuite
                de l'utilisation après notification vaut acceptation de la
                nouvelle version.
            </p>

            <h2>14. Droit applicable et litiges</h2>
            <p>
                Les présentes conditions sont soumises au droit français.
                Avant toute action, l'utilisateur est invite à contacter
                <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a>. Il
                peut également recourir gratuitement au médiateur de la
                consommation désigné, dont les coordonnées figurent dans les
                <a href="{{ route('legal.mentions') }}">mentions légales</a>.
            </p>
        </article>

    </div>
</section>

@endsection
