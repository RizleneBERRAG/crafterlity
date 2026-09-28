@extends('layouts.app')

@section('titre', 'Politique de confidentialité')
@section('description', "Quelles données Crafterlity collecte, pourquoi, avec qui elles sont partagées, combien de temps elles sont conservées et comment exercer vos droits.")

@section('contenu')

@php $s = config('crafterlity.societe'); @endphp

<section class="bande jour">
    <div class="wrap etroit">

        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Confidentialité</span>
        </nav>

        <article class="legal">
            <h1 style="font-size:clamp(2rem,4.2vw,3.2rem)">Politique de confidentialité</h1>
            <p class="maj">Dernière mise à jour : {{ $maj }}</p>

            {{--
                Le texte reprend la politique publiee par Crafterlity au
                2 juin 2026, remise en forme pour ce site : memes traitements,
                memes bases legales, memes durees. Seul le nom de l'editeur a
                ete aligne.

                La version en ligne designe « TinArt » comme editeur du
                service, alors que l'entreprise immatriculee est CRAFTERLITY
                (SIREN 105 409 148). Deux noms differents sur deux documents
                qui engagent, c'est un point a trancher : soit TinArt est un
                nom commercial et il doit etre declare, soit c'est un reliquat
                et il faut le corriger partout. Ici, la raison sociale a ete
                retenue, pour que cette page et les mentions legales disent la
                meme chose.
            --}}

            <p>
                Cette politique explique comment Crafterlity collecte, utilise,
                partage et protégé les données personnelles lorsque vous
                utilisez l'application mobile Crafterlity.
            </p>

            <dl class="identite">
                <dt>Responsable de traitement</dt><dd>{{ $s['raison'] }}</dd>
                <dt>Adresse</dt><dd>{{ $s['adresse'] }}, {{ $s['code_postal'] }} {{ $s['ville'] }}, {{ $s['pays'] }}</dd>
                <dt>Contact</dt><dd><a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a></dd>
            </dl>

            <p>
                Crafterlity est une application permettant à des particuliers
                de demander une intervention, et à des professionnels de
                proposer, suivre et réaliser des missions.
            </p>

            <h2>1. Données collectées</h2>

            <h3>Données de compte</h3>
            <ul>
                <li>adresse électronique, prénom et nom, numéro de téléphone ;</li>
                <li>mot de passe, stocke sous forme sécurisée ;</li>
                <li>jetons d'authentification et de session ;</li>
                <li>méthode de connexion utilisée : courriel, Apple ou Google ;</li>
                <li>consentements acceptés, notamment les conditions générales et la présente politique ;</li>
                <li>dates de création, de mise à jour, de vérification de l'adresse et de dernière connexion.</li>
            </ul>

            <h3>Données professionnelles</h3>
            <ul>
                <li>nom de l'entreprise, SIRET ou SIREN, forme juridique, date d'immatriculation ;</li>
                <li>adresse de l'établissement ;</li>
                <li>statut de vérification et d'integration, disponibilité, spécialités ;</li>
                <li>informations publiques ou administratives récupérées via les services de l'INSEE afin de vérifier l'activité.</li>
            </ul>

            <h3>Données de mission</h3>
            <ul>
                <li>type de besoin, titre, description et informations saisies dans le formulaire ;</li>
                <li>urgence, date et horaire souhaités ;</li>
                <li>adresse d'intervention, ville, code postal et coordonnées géographiques lorsque nécessaire ;</li>
                <li>photographies ajoutées pour illustrer la mission ;</li>
                <li>offres, prix, délais d'arrivée estimés, messages, statuts et motifs d'annulation ;</li>
                <li>suivi d'intervention : « en route », « arrive », « en cours », « termine ».</li>
            </ul>

            <h3>Localisation</h3>
            <p>La localisation sert à :</p>
            <ul>
                <li>aider un client à renseigner son adresse d'intervention ;</li>
                <li>calculer et afficher les distances entre une mission et un professionnel ;</li>
                <li>permettre au client de suivre l'arrivée du professionnel lorsqu'une mission est acceptée.</li>
            </ul>
            <p>
                Pour les professionnels, la position peut être traitée en
                arrière-plan <strong>uniquement pendant le trajet lie à une
                mission acceptée</strong>, lorsque le partage est active pour
                cette mission. Le suivi cesse dès que la mission quitte le
                statut « en route » ou que le professionnel l'interrompt.
            </p>

            <h3>Photographies</h3>
            <p>
                Seules les images que vous choisissez d'ajouter à une mission
                sont collectées. Elles servent à comprendre le besoin et à
                documenter l'intervention.
            </p>

            <h3>Paiements et versements</h3>
            <p>
                Crafterlity utilise Stripe pour traiter les paiements, vérifier
                certains professionnels et gérer les versements. Peuvent être
                traités ou transmis à Stripe :
            </p>
            <ul>
                <li>montant, frais de service et identifiant de paiement d'une mission ;</li>
                <li>informations du compte Stripe Connect d'un professionnel ;</li>
                <li>éléments nécessaires à la vérification d'identité d'un représentant légal ou bénéficiaire effectif ;</li>
                <li>coordonnées bancaires nécessaires aux versements, notamment l'IBAN et le nom du titulaire.</li>
            </ul>
            <p>
                Les données de carte bancaire sont collectées directement par
                Stripe ou transmises sous forme de jeton. Stripe applique ses
                propres règles de sécurité aux données de paiement.
            </p>

            <h3>Notifications et données techniques</h3>
            <ul>
                <li>jeton de notification, plateforme utilisée, identifiant technique de l'appareil ;</li>
                <li>journaux serveur pouvant inclure l'adresse IP, l'horodatage des requêtes et les informations de diagnostic ;</li>
                <li>langue ou région de l'appareil, pour afficher l'application dans la bonne langue.</li>
            </ul>

            <h2>2. Finalités</h2>
            <ul>
                <li>créer et gérer votre compte, vous authentifier ;</li>
                <li>vérifier les comptes professionnels ;</li>
                <li>permettre la création, la publication, l'affectation, le suivi et la clôture des missions ;</li>
                <li>traiter les paiements, remboursements et versements, et lutter contre la fraude ;</li>
                <li>envoyer les notifications liées aux missions ;</li>
                <li>assurer le support utilisateur ;</li>
                <li>respecter les obligations légales, comptables et fiscales ;</li>
                <li>améliorer la qualité et la stabilité du service.</li>
            </ul>
            <p>
                <strong>Vos données ne sont ni vendues, ni utilisées à des
                fins de ciblage publicitaire.</strong>
            </p>

            <h2>3. Bases légales</h2>
            <ul>
                <li><strong>Exécution du contrat</strong> — fourniture du service, gestion des comptes, des missions et des paiements ;</li>
                <li><strong>Consentement</strong> — notifications, localisation, accès à l'appareil photo et à la photothèque ;</li>
                <li><strong>Intérêt légitime</strong> — sécurité du service, prévention de la fraude, support, fiabilité ;</li>
                <li><strong>Obligation légale</strong> — comptabilité, fiscalité, obligations liées aux services de paiement.</li>
            </ul>

            <h2>4. Partage des données</h2>

            <h3>Avec les autres utilisateurs</h3>
            <ul>
                <li>certains détails de mission sont visibles par les professionnels éligibles : catégorie, description, planning, ville ou adresse selon l'étape ;</li>
                <li>le client voit le nom, l'entreprise, le profil, l'offre, la distance et le suivi d'arrivée du professionnel retenu ;</li>
                <li>le professionnel retenu accède à l'adresse exacte une fois la mission assignée.</li>
            </ul>

            <h3>Avec nos prestataires</h3>
            <ul>
                <li>hébergement, interfaces de programmation et infrastructure technique ;</li>
                <li>stockage et diffusion des images de mission ;</li>
                <li>notifications ;</li>
                <li>paiement et vérification, notamment Stripe ;</li>
                <li>cartographie, géocodage et calcul d'itineraire ;</li>
                <li>services publics permettant de vérifier les informations d'entreprise, notamment l'INSEE ;</li>
                <li>connexion Apple ou Google lorsque vous utilisez ces modes d'authentification.</li>
            </ul>

            <h3>Pour des raisons légales</h3>
            <p>
                Des données peuvent être communiquées pour respecter la loi,
                répondre à une autorité compétente, prévenir une fraude ou
                assurer la sécurité des utilisateurs.
            </p>

            <h2>5. Conservation</h2>
            <ul>
                <li>données de compte : tant que le compte est actif ;</li>
                <li>données de mission : le temps nécessaire à l'exécution, au support, à la preuve contractuelle et aux obligations légales ;</li>
                <li>paiement, facturation et comptabilité : pendant les durées légales applicables ;</li>
                <li>jetons de notification : tant que vous utilisez les notifications ;</li>
                <li>positions de trajet : le temps du suivi, de la preuve de l'intervention et du support.</li>
            </ul>
            <p>
                A la suppression du compte, les données qui ne sont plus
                nécessaires sont supprimées ou anonymisées, sauf lorsque leur
                conservation est requise par la loi ou nécessaire à la défense
                de droits, à la sécurité ou au règlement d'un litige.
            </p>

            <h2>6. Sécurité</h2>
            <ul>
                <li>transmission via des connexions chiffrées ;</li>
                <li>stockage sécurisé des jetons d'authentification sur l'appareil ;</li>
                <li>accès limites aux personnes et services qui en ont besoin ;</li>
                <li>recours à des prestataires reconnus pour les paiements et les vérifications.</li>
            </ul>

            <h2>7. Vos droits</h2>
            <p>
                Conformément au règlement général sur la protection des données,
                vous pouvez demander l'accès, la rectification, l'effacement,
                la limitation, la portabilité de vos données, vous opposer à
                certains traitements et retirer votre consentement.
            </p>
            <p>
                Vous pouvez également gérer les autorisations de localisation,
                de notifications, d'appareil photo et de photothèque depuis les
                réglages de votre téléphone.
            </p>
            <p>
                Pour exercer vos droits :
                <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a>. Des
                informations complémentaires peuvent vous être demandées afin
                de vérifier votre identité. Vous pouvez introduire une
                réclamation auprès de la
                <a href="https://www.cnil.fr/" rel="noopener">CNIL</a>.
            </p>

            <h2>8. Suppression du compte</h2>
            <p>
                Depuis les parametres de l'application lorsque la fonction y
                est disponible, ou en écrivant à
                <a href="mailto:{{ $s['email'] }}">{{ $s['email'] }}</a> avec
                pour objet « Suppression de compte Crafterlity ».
            </p>

            <h2>9. Transferts hors Union européenne</h2>
            <p>
                Certains prestataires peuvent traiter des données hors de
                l'Union européenne. Ces transferts sont encadres par des
                garanties appropriées, notamment des clauses contractuelles
                types.
            </p>

            <h2>10. Mineurs</h2>
            <p>
                L'application est réservée aux personnes majeures ou disposant
                de la capacité juridique nécessaire. Si nous apprenons qu'un
                mineur nous a transmis des données sans autorisation valable,
                nous prendrons les mesures raisonnables pour les supprimer.
            </p>

            <h2>11. Modification</h2>
            <p>
                Cette politique peut être mise à jour. La date figurant en
                haut de page sera modifiée ; en cas de changement important,
                vous en serez informe dans l'application.
            </p>

            <h2>12. Ce site</h2>
            {{--
                Ce chapitre n'existe pas dans la politique publiee : elle ne
                traite que l'application. Un site vitrine qui pose un cookie
                de session et enregistre un formulaire doit le dire, meme si
                c'est pour dire qu'il ne fait presque rien.
            --}}
            <p>
                Le présent site ne déposé aucun traceur publicitaire et
                n'utilise aucun outil de mesure d'audience tiers. Les polices
                de caractères sont hébergées sur nos serveurs : aucune requête
                n'est adressée à un domaine tiers lors de votre visite.
            </p>
            <p>
                Un unique cookie de session est déposé lors de l'envoi du
                formulaire de contact ; il assure la protection contre la
                falsification de requête et expire à la fermeture du
                navigateur. Les messages envoyes via ce formulaire sont
                conservés le temps nécessaire au traitement de la demande.
            </p>
        </article>

    </div>
</section>

@endsection
