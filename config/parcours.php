<?php

/*
|--------------------------------------------------------------------------
| Les deux parcours, et les questions qu'ils soulevent
|--------------------------------------------------------------------------
|
| Crafterlity a deux publics qui ne cherchent pas la meme chose. Le
| particulier veut savoir combien ca coute et qui va sonner chez lui. Le
| professionnel veut savoir combien de missions il recevra et quand il sera
| paye. Les melanger sur une meme page, c'est perdre les deux.
|
| D'ou deux parcours decrits separement, et une FAQ qui porte l'etiquette de
| son public.
|
*/

return [

    /*
    | Le parcours client. Quatre etapes, pas cinq : au-dela, le lecteur
    | comprend que c'est complique, ce qui est exactement l'inverse du
    | message.
    */
    'client' => [
        [
            'titre'  => 'Décrivez ce qui ne va pas',
            'texte'  => "Choisissez la catégorie, écrivez le problème avec vos mots, ajoutez des photos. Indiquez l'adresse et le créneau qui vous arrange — ou cochez « urgence » si cela ne peut pas attendre.",
            'detail' => 'Deux minutes, sans appel téléphonique',
        ],
        [
            'titre'  => 'Recevez des propositions',
            'texte'  => "Votre demande part vers les professionnels disponibles autour de votre adresse. Ils vous répondent avec un prix et un délai d'arrivée. Vous ne recevez que des offres fermes.",
            'detail' => "Le prix est annoncé avant l'intervention",
        ],
        [
            'titre'  => 'Choisissez, puis suivez',
            'texte'  => "Comparez les offres, le profil et les missions déjà réalisées. Une fois votre choix fait, vous suivez l'arrivée du technicien sur la carte, comme une course.",
            'detail' => 'Vous savez qui vient, et quand',
        ],
        [
            'titre'  => "Payez quand c'est fait",
            'texte'  => "Le règlement passe par l'application. Aucune carte ne change de main sur le pas de la porte, et le professionnel est versé une fois la mission terminée.",
            'detail' => 'Paiement sécurisé par Stripe',
        ],
    ],

    /*
    | Le parcours professionnel. Le ton change : on ne rassure plus, on
    | repond a « qu'est-ce que j'y gagne et qu'est-ce que ca me coute ».
    */
    'pro' => [
        [
            'titre'  => 'Créez votre profil',
            'texte'  => "Votre SIRET est vérifié auprès de l'INSEE : raison sociale, forme juridique, date d'immatriculation. C'est ce contrôle qui permet d'afficher « artisan vérifié » aux clients — et qui vous distingue des annonces sans identité.",
            'detail' => 'Vérification automatique, aucun dossier à envoyer',
        ],
        [
            'titre'  => 'Recevez les missions de votre secteur',
            'texte'  => "Vous choisissez vos spécialités et votre rayon d'intervention. Les demandes qui y correspondent arrivent par notification, avec la description, les photos et le créneau souhaité.",
            'detail' => 'Vous décidez de votre zone et de vos horaires',
        ],
        [
            'titre'  => 'Envoyez votre offre',
            'texte'  => "Vous annoncez votre prix et votre délai. Pas d'enchère inversée, pas de contact revendu à cinq confrères : le client compare des propositions complètes et choisit.",
            'detail' => 'Votre prix, pas un tarif imposé',
        ],
        [
            'titre'  => 'Intervenez et soyez payé',
            'texte'  => "Vous indiquez votre départ, votre arrivée, puis la fin de la mission. Le versement est déclenché sur votre compte Stripe Connect, vers l'IBAN de votre entreprise.",
            'detail' => "Pas de relance, pas d'impayé à courir",
        ],
    ],

    /*
    | La FAQ. Elle sert deux fois : elle rassure le visiteur, et elle
    | alimente le bloc FAQPage en donnees structurees, que Google affiche
    | directement dans ses resultats. Les reponses sont donc ecrites pour
    | tenir seules, hors de leur page.
    */
    'faq' => [

        ['public' => 'client', 'q' => "Crafterlity est-il gratuit pour les particuliers ?",
         'r' => "Oui. Créer un compte, publier une demande et recevoir des propositions ne coûte rien. Vous ne réglez que l'intervention elle-même, au prix annoncé par le professionnel que vous avez choisi."],

        ['public' => 'client', 'q' => "Comment savez-vous que les artisans sont sérieux ?",
         'r' => "Chaque professionnel déclare son SIRET, qui est vérifié auprès des services de l'INSEE : l'entreprise existe, elle est immatriculée, son activité est déclarée. S'y ajoutent la vérification d'identité du représentant légal réalisée par Stripe, et l'historique des missions réalisées sur la plateforme."],

        ['public' => 'client', 'q' => "Que veut dire « intervention en moins d'une heure » ?",
         'r' => "Pour la plomberie, l'électricité, la serrurerie, la vitrerie et le chauffage, votre demande est signalée comme urgente et envoyée en priorité aux professionnels les plus proches de votre adresse. Le délai dépend de leur disponibilité réelle au moment où vous publiez : l'application vous montre le délai annoncé par chacun avant que vous acceptiez."],

        ['public' => 'client', 'q' => "Le prix peut-il changer pendant l'intervention ?",
         'r' => "L'offre que vous acceptez porte un prix ferme. Si le professionnel découvre sur place que le travail est plus important que ce que décrivaient votre message et vos photos, il doit vous le dire et vous proposer un nouveau montant, que vous restez libre de refuser."],

        ['public' => 'client', 'q' => "Comment se passe le paiement ?",
         'r' => "Le règlement se fait dans l'application, par carte, via Stripe. Vos données bancaires ne transitent pas par les serveurs de Crafterlity : elles sont collectées directement par Stripe. Le professionnel est versé une fois la mission terminée."],

        ['public' => 'client', 'q' => "Dans quelles villes Crafterlity fonctionne-t-il ?",
         'r' => "Le service se déploie d'abord sur la métropole de Lyon et sa périphérie sud, où se trouve l'équipe. La couverture dépend du nombre de professionnels inscrits autour de votre adresse : l'application vous le dit dès que vous saisissez votre code postal."],

        ['public' => 'client', 'q' => "Puis-je annuler une demande ?",
         'r' => "Oui. Tant qu'aucune offre n'a été acceptée, l'annulation est immédiate et sans frais. Une fois le professionnel en route, prévenez-le depuis la messagerie de l'application : un déplacement engagé peut donner lieu à des frais, indiqués dans les conditions générales."],

        ['public' => 'pro', 'q' => "Que coûte Crafterlity à un artisan ?",
         'r' => "L'inscription et la réception des missions sont gratuites, sans abonnement. Une commission n'est prélevée que sur les missions effectivement réalisées et payées via l'application. Vous ne payez jamais pour un contact qui n'a rien donné."],

        ['public' => 'pro', 'q' => "Faut-il être inscrit au répertoire des métiers ?",
         'r' => "Il faut une entreprise immatriculée et un SIRET actif : artisan inscrit au répertoire des métiers, société au registre du commerce, ou micro-entreprise déclarée. Les activités réglementées restent soumises à leurs propres obligations de qualification et d'assurance."],

        ['public' => 'pro', 'q' => "Quand suis-je payé ?",
         'r' => "Le versement est déclenché une fois la mission marquée comme terminée, vers le compte Stripe Connect associé à l'IBAN de votre entreprise. Le délai de mise à disposition dépend ensuite de votre banque."],

        ['public' => 'pro', 'q' => "Mes coordonnées sont-elles revendues ?",
         'r' => "Non. Crafterlity ne vend pas de fichiers et ne revend pas de contacts. Vos données servent à vous mettre en relation avec des clients, à vérifier votre activité et à vous verser vos paiements — rien d'autre."],

        ['public' => 'pro', 'q' => "Puis-je refuser une mission ?",
         'r' => "Oui, librement. Vous n'êtes ni salarié ni tenu par un volume : vous répondez aux demandes qui vous intéressent, dans la zone et sur les créneaux que vous avez définis."],

    ],

    /*
    | La zone servie. Une plateforme locale qui pretend couvrir la France
    | entiere le premier jour ne trompe personne : on nomme les communes ou
    | l'equipe est reellement presente, et on dit franchement que le reste
    | arrive.
    */
    'zone' => [
        'Lyon', 'Villeurbanne', 'Vénissieux', 'Saint-Priest', 'Bron',
        'Caluire-et-Cuire', 'Oullins-Pierre-Bénite', 'Saint-Fons', 'Feyzin',
        'Givors', 'Ternay', 'Communay', 'Sérézin-du-Rhône', 'Vienne',
    ],

];
