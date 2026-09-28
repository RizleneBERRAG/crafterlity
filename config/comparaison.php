<?php

/*
|--------------------------------------------------------------------------
| Le meme mardi matin, raconte deux fois
|--------------------------------------------------------------------------
|
| Un chauffe-eau lache un mardi a huit heures quarante. A gauche, ce qui se
| passe aujourd'hui. A droite, ce qui se passe avec l'application.
|
| POURQUOI PAS UN TABLEAU COMPARATIF. Le tableau a deux colonnes avec des
| croix rouges en face du concurrent et des coches vertes en face de soi est
| le signe le plus sur d'un argumentaire : il se lit comme une publicite, et
| il se discute ligne par ligne. Deux recits horodates ne se discutent pas —
| chacun reconnait sa propre matinee dans la colonne de gauche, et tire la
| conclusion tout seul. Une conclusion qu'on tire soi-meme est la seule
| qu'on garde.
|
| Le recit de gauche ne caricature pas : il ne met en scene ni artisan
| malhonnete, ni devis gonfle. Rien que des messageries, des rappels promis
| et des creneaux lointains — c'est-a-dire ce que tout le monde a vecu. Une
| exageration serait reperee, et emporterait le reste avec elle.
|
*/

return [

    'situation' => "Un chauffe-eau qui lâche, un mardi matin. Même panne, même ville, même personne.",

    'avant' => [
        'titre' => 'Sans Crafterlity',
        'quoi'  => 'Au téléphone',
        'total' => '2 j 6 h',
        'note'  => "Prix découvert sur place",
        'lignes' => [
            ['h' => '08 h 40', 't' => "Premier plombier appelé. Messagerie."],
            ['h' => '09 h 05', 't' => "Deuxième appel. « Je vous rappelle dans la journée. »"],
            ['h' => '09 h 50', 't' => "Troisième. Pas de créneau avant jeudi."],
            ['h' => '11 h 20', 't' => "Quatrième. Un prix annoncé oralement, « à confirmer sur place »."],
            ['h' => '14 h 10', 't' => "Rappel du deuxième. Il peut passer, mais vendredi."],
            ['h' => 'Jeudi',   't' => "Intervention. Le montant a changé."],
        ],
    ],

    'apres' => [
        'titre' => 'Avec Crafterlity',
        'quoi'  => "Dans l'application",
        'total' => '26 min',
        'note'  => "Prix accepté avant le départ",
        'lignes' => [
            ['h' => '08 h 40', 't' => "Demande publiée, deux photos jointes, urgence cochée."],
            ['h' => '08 h 43', 't' => "Première offre — 120 €, arrivée annoncée dans 18 min."],
            ['h' => '08 h 45', 't' => "Deuxième offre — 95 €, dans 35 min."],
            ['h' => '08 h 47', 't' => "Troisième offre — 89 €, demain 9 h."],
            ['h' => '08 h 48', 't' => "Offre à 95 € acceptée. Le trajet s'affiche."],
            ['h' => '09 h 06', 't' => "Technicien sur place. Le montant n'a pas bougé."],
        ],
    ],

];
