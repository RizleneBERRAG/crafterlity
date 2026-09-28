<?php

/*
|--------------------------------------------------------------------------
| Les metiers couverts par Crafterlity
|--------------------------------------------------------------------------
|
| Chaque metier a sa propre page. Ce n'est pas un caprice d'architecture :
| personne ne cherche « plateforme de mise en relation avec des artisans ».
| On cherche « plombier Lyon fuite », « serrurier porte claquee ». Une page
| par metier, c'est une porte d'entree par intention de recherche — et c'est
| aujourd'hui ce qui manque totalement a crafterlity.com, qui n'expose que
| trois pages legales.
|
| Les champs :
|   slug      l'adresse de la page, et la cle de l'icone. Sans accent ni
|             majuscule : une adresse se recopie a la main et se lit au
|             telephone. C'est le SEUL champ qui n'est pas du francais
|             affichable — tous les autres partent tels quels a l'ecran.
|   nom       le metier, tel qu'on le nomme dans l'application
|   requete   ce que le visiteur tape reellement — sert au titre de la page
|   pluriel   le pluriel du metier, ecrit et non calcule : coller un « s »
|             donnait « homme toutes mainss » et « peintre en batiments »
|   urgence   le metier accepte-t-il les interventions en moins d'une heure
|   resume    une phrase, affichee sur les cartes
|   besoins   les interventions concretes, telles qu'un client les decrit
|
*/

return [

    [
        'slug'    => 'plomberie',
        'nom'     => 'Plomberie',
        'requete' => 'Plombier',
        'pluriel' => 'plombiers',
        'urgence' => true,
        'resume'  => "Fuite, canalisation bouchée, chauffe-eau en panne : le plombier se déplace, souvent le jour même.",
        'besoins' => [
            "Fuite d'eau sous un évier ou derrière une cloison",
            "Canalisation ou WC bouché",
            "Chauffe-eau qui ne chauffe plus",
            "Remplacement d'un robinet, d'un mitigeur, d'un flexible",
            "Installation d'une machine à laver ou d'un lave-vaisselle",
            "Dégât des eaux : coupure, recherche de fuite, remise en état",
        ],
    ],

    [
        'slug'    => 'electricite',
        'nom'     => 'Électricité',
        'requete' => 'Électricien',
        'pluriel' => 'électriciens',
        'urgence' => true,
        'resume'  => "Panne de courant, tableau qui disjoncte, prise morte : un électricien diagnostique et répare.",
        'besoins' => [
            "Panne de courant totale ou partielle",
            "Disjoncteur qui saute sans raison apparente",
            "Prise, interrupteur ou luminaire hors service",
            "Mise aux normes d'un tableau électrique",
            "Pose de points lumineux, de prises supplémentaires",
            "Installation d'un interphone, d'un visiophone, d'une borne de recharge",
        ],
    ],

    [
        'slug'    => 'serrurerie',
        'nom'     => 'Serrurerie',
        'requete' => 'Serrurier',
        'pluriel' => 'serruriers',
        'urgence' => true,
        'resume'  => "Porte claquée, clé perdue, serrure forcée : ouverture et remplacement, prix annoncé avant le déplacement.",
        'besoins' => [
            "Porte claquée ou clé cassée dans la serrure",
            "Ouverture après perte des clés",
            "Remplacement d'un cylindre ou d'une serrure complète",
            "Remise en état après une tentative d'effraction",
            "Pose d'une serrure multipoints, blindage de porte",
            "Volet roulant ou rideau métallique bloqué",
        ],
    ],

    [
        'slug'    => 'chauffage-climatisation',
        'nom'     => 'Chauffage et climatisation',
        'requete' => 'Chauffagiste',
        'pluriel' => 'chauffagistes',
        'urgence' => true,
        'resume'  => "Chaudière en panne, radiateur froid, climatisation à installer : entretien et dépannage thermique.",
        'besoins' => [
            "Chaudière en panne ou mise en sécurité",
            "Entretien annuel obligatoire",
            "Radiateur froid, purge et désembouage",
            "Installation ou entretien d'une pompe à chaleur",
            "Pose d'une climatisation réversible",
            "Remplacement d'un thermostat, passage en programmation connectée",
        ],
    ],

    [
        'slug'    => 'peinture',
        'nom'     => 'Peinture',
        'requete' => 'Peintre en bâtiment',
        'pluriel' => 'peintres en bâtiment',
        'urgence' => false,
        'resume'  => "Une pièce, un appartement entier ou une façade : préparation des supports et finition propre.",
        'besoins' => [
            "Remise en peinture d'une pièce ou d'un logement complet",
            "Rebouchage, enduit, ponçage avant finition",
            "Pose ou dépose de papier peint, de toile de verre",
            "Peinture de plafond, de boiseries, de radiateurs",
            "Ravalement ou rafraîchissement de façade",
            "Remise en état avant un état des lieux de sortie",
        ],
    ],

    [
        'slug'    => 'carrelage',
        'nom'     => 'Carrelage et faïence',
        'requete' => 'Carreleur',
        'pluriel' => 'carreleurs',
        'urgence' => false,
        'resume'  => "Sol, crédence, salle de bains : pose, reprise de joints et remplacement de carreaux cassés.",
        'besoins' => [
            "Pose de carrelage au sol ou au mur",
            "Crédence de cuisine, faïence de salle de bains",
            "Remplacement de carreaux fêlés ou descellés",
            "Reprise de joints noircis ou fissurés",
            "Étanchéité avant pose dans une pièce humide",
            "Ragréage et préparation du support",
        ],
    ],

    [
        'slug'    => 'menuiserie',
        'nom'     => 'Menuiserie',
        'requete' => 'Menuisier',
        'pluriel' => 'menuisiers',
        'urgence' => false,
        'resume'  => "Portes, fenêtres, parquet, placards : pose, ajustement et réparation du bois et du PVC.",
        'besoins' => [
            "Porte intérieure qui frotte, qui ferme mal",
            "Pose ou remplacement de fenêtres, double vitrage",
            "Parquet à poser, à réparer, à rénover",
            "Placard sur mesure, dressing, étagères encastrées",
            "Volets, persiennes, portes de garage",
            "Plinthes, habillages, finitions bois",
        ],
    ],

    [
        'slug'    => 'montage-de-meubles',
        'nom'     => 'Montage de meubles',
        'requete' => 'Monteur de meubles',
        'pluriel' => 'monteurs de meubles',
        'urgence' => false,
        'resume'  => "Cuisine, dressing, lit, bureau : le meuble est monté, fixé et calé, les cartons repartent avec.",
        'besoins' => [
            "Montage d'une cuisine en kit",
            "Dressing, armoire, bibliothèque",
            "Lit, sommier, canapé modulable",
            "Bureau et mobilier de télétravail",
            "Fixation murale sécurisée, anti-basculement",
            "Démontage et remontage lors d'un déménagement",
        ],
    ],

    [
        'slug'    => 'petits-travaux',
        'nom'     => 'Petits travaux',
        'requete' => 'Homme toutes mains',
        'pluriel' => 'hommes toutes mains',
        'urgence' => false,
        'resume'  => "Les vingt minutes de travail pour lesquelles personne ne veut se déplacer. Ici, si.",
        'besoins' => [
            "Fixation d'une télévision murale, d'une étagère, d'un miroir",
            "Pose de tringles, de stores, de rideaux",
            "Remplacement d'un joint de silicone",
            "Petites reprises de plâtre, trous à reboucher",
            "Installation d'une boîte aux lettres, d'un numéro de rue",
            "Liste de petites réparations réunies en une seule visite",
        ],
    ],

    [
        'slug'    => 'vitrerie',
        'nom'     => 'Vitrerie',
        'requete' => 'Vitrier',
        'pluriel' => 'vitriers',
        'urgence' => true,
        'resume'  => "Bris de glace, vitre fissurée, miroir sur mesure : sécurisation immédiate puis remplacement.",
        'besoins' => [
            "Bris de glace : sécurisation puis remplacement",
            "Vitre simple ou double vitrage fissuré",
            "Remplacement d'un vitrage de porte",
            "Miroir sur mesure, crédence en verre",
            "Joint de vitrage à reprendre",
            "Survitrage et amélioration thermique",
        ],
    ],

];
