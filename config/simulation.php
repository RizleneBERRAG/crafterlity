<?php

/*
|--------------------------------------------------------------------------
| Le simulateur de demande
|--------------------------------------------------------------------------
|
| Des donnees d'exemple, et rien d'autre. Elles alimentent la demonstration
| interactive de la page d'accueil : le visiteur choisit un metier, publie
| une demande fictive, voit arriver des offres, en accepte une et suit le
| trajet — sans installer l'application.
|
| POURQUOI CE BLOC EXISTE. Une plateforme de mise en relation ne se raconte
| pas, elle se montre. Trois captures d'ecran ne diront jamais ce que dit
| une demande qu'on publie soi-meme et une offre qui arrive trente secondes
| plus tard. C'est le seul endroit du site ou le visiteur FAIT quelque chose
| au lieu de lire.
|
| CE QUE CES DONNEES NE SONT PAS. Ce ne sont ni de vrais artisans, ni de
| vrais tarifs, ni des delais garantis. Le composant l'affiche noir sur
| blanc, en toutes lettres, au-dessus et en dessous de la simulation. Sur un
| site qui doit prouver qu'il n'est pas une arnaque, presenter des donnees
| inventees comme reelles serait exactement l'erreur a ne pas commettre.
|
| Les prix sont des ordres de grandeur du marche francais pour une
| intervention courante ; ils devront etre valides ou retires par
| Crafterlity avant mise en ligne.
|
*/

return [

    /*
    | Ce que le visiteur voit s'ecrire dans le champ de description quand il
    | choisit un metier. Le texte est tape caractere par caractere : c'est ce
    | qui donne l'impression que quelqu'un remplit le formulaire.
    */
    'exemples' => [
        'plomberie'               => "Fuite sous l'évier de la cuisine, ça goutte depuis ce matin et la bassine se remplit vite.",
        'electricite'             => "Plus de courant dans la moitié de l'appartement, le disjoncteur resaute dès que je le relève.",
        'serrurerie'              => "Porte d'entrée claquée, les clés sont restées à l'intérieur. Je suis sur le palier.",
        'chauffage-climatisation' => "La chaudière s'est mise en sécurité cette nuit, plus d'eau chaude ni de chauffage.",
        'peinture'                => "Un salon de 22 m² à remettre en peinture, murs et plafond, avant un état des lieux.",
        'carrelage'               => "Trois carreaux fêlés dans l'entrée à remplacer, j'ai les carreaux de rechange.",
        'menuiserie'              => "La porte de la chambre frotte au sol et ne ferme plus correctement depuis l'été.",
        'montage-de-meubles'      => "Une cuisine en kit à monter, huit caissons plus le plan de travail à découper.",
        'petits-travaux'          => "Une télévision de 55 pouces à fixer au mur, cloison en placo, support fourni.",
        'vitrerie'                => "Vitre de la porte-fenêtre fissurée sur toute la hauteur, ça tient mais c'est net.",
    ],

    /*
    | Les offres qui arrivent. Trois par metier : une rapide et chere, une
    | equilibree, une moins chere mais plus lointaine. C'est exactement
    | l'arbitrage que fait un client, et le montrer vaut mieux que l'ecrire.
    |
    | delai    minutes avant arrivee, pour une demande urgente
    | jour     creneau propose, pour une demande planifiee
    */
    'offres' => [

        'plomberie' => [
            ['nom' => 'Karim B.',    'entreprise' => 'KB Plomberie',        'note' => '4,8', 'missions' => 143, 'km' => '1,2', 'prix' => 120, 'delai' => 18, 'jour' => "aujourd'hui, 14 h"],
            ['nom' => 'Sofiane M.',  'entreprise' => 'SM Sanitaire',        'note' => '4,6', 'missions' => 87,  'km' => '2,8', 'prix' => 95,  'delai' => 35, 'jour' => "aujourd'hui, 17 h"],
            ['nom' => 'Thierry L.',  'entreprise' => 'Ets Lavaud',          'note' => '4,9', 'missions' => 312, 'km' => '5,4', 'prix' => 89,  'delai' => 55, 'jour' => 'demain, 9 h'],
        ],

        'electricite' => [
            ['nom' => 'Louis T.',    'entreprise' => 'Thomas Électricité',  'note' => '4,7', 'missions' => 128, 'km' => '0,9', 'prix' => 110, 'delai' => 12, 'jour' => "aujourd'hui, 15 h"],
            ['nom' => 'Rachid A.',   'entreprise' => 'AR Élec',             'note' => '4,8', 'missions' => 201, 'km' => '3,1', 'prix' => 95,  'delai' => 30, 'jour' => 'demain, 8 h'],
            ['nom' => 'Pierre G.',   'entreprise' => 'Gonnet & Fils',       'note' => '4,5', 'missions' => 64,  'km' => '6,2', 'prix' => 85,  'delai' => 50, 'jour' => 'demain, 11 h'],
        ],

        'serrurerie' => [
            ['nom' => 'Mehdi K.',    'entreprise' => 'Serrurerie du Rhône', 'note' => '4,9', 'missions' => 276, 'km' => '1,6', 'prix' => 140, 'delai' => 15, 'jour' => "aujourd'hui, 13 h"],
            ['nom' => 'Bruno V.',    'entreprise' => 'BV Sécurité',         'note' => '4,7', 'missions' => 158, 'km' => '3,4', 'prix' => 125, 'delai' => 28, 'jour' => "aujourd'hui, 16 h"],
            ['nom' => 'Anis D.',     'entreprise' => 'AD Ouverture',        'note' => '4,6', 'missions' => 92,  'km' => '7,1', 'prix' => 110, 'delai' => 45, 'jour' => 'demain, 10 h'],
        ],

        'chauffage-climatisation' => [
            ['nom' => 'Olivier R.',  'entreprise' => 'Rey Thermique',       'note' => '4,8', 'missions' => 184, 'km' => '2,2', 'prix' => 145, 'delai' => 40, 'jour' => "aujourd'hui, 18 h"],
            ['nom' => 'Samir H.',    'entreprise' => 'SH Chauffage',        'note' => '4,6', 'missions' => 119, 'km' => '4,5', 'prix' => 130, 'delai' => 60, 'jour' => 'demain, 8 h 30'],
            ['nom' => 'Denis P.',    'entreprise' => 'Perret Énergie',      'note' => '4,9', 'missions' => 341, 'km' => '8,3', 'prix' => 120, 'delai' => 90, 'jour' => 'demain, 14 h'],
        ],

        'peinture' => [
            ['nom' => 'Yanis C.',    'entreprise' => 'YC Décoration',       'note' => '4,7', 'missions' => 96,  'km' => '2,4', 'prix' => 780, 'delai' => null, 'jour' => 'jeudi, 8 h'],
            ['nom' => 'Marc D.',     'entreprise' => 'Dupuis Peinture',     'note' => '4,8', 'missions' => 173, 'km' => '4,1', 'prix' => 690, 'delai' => null, 'jour' => 'vendredi, 8 h'],
            ['nom' => 'Éric N.',     'entreprise' => 'EN Finitions',        'note' => '4,5', 'missions' => 58,  'km' => '9,0', 'prix' => 640, 'delai' => null, 'jour' => 'lundi, 9 h'],
        ],

        'carrelage' => [
            ['nom' => 'Paulo S.',    'entreprise' => 'PS Carrelage',        'note' => '4,8', 'missions' => 131, 'km' => '3,0', 'prix' => 240, 'delai' => null, 'jour' => 'mercredi, 9 h'],
            ['nom' => 'Hakim Z.',    'entreprise' => 'HZ Revêtements',      'note' => '4,6', 'missions' => 77,  'km' => '5,2', 'prix' => 210, 'delai' => null, 'jour' => 'jeudi, 14 h'],
            ['nom' => 'Joël M.',     'entreprise' => 'Martin & Fils',       'note' => '4,9', 'missions' => 254, 'km' => '7,8', 'prix' => 195, 'delai' => null, 'jour' => 'vendredi, 8 h'],
        ],

        'menuiserie' => [
            ['nom' => 'Antoine F.',  'entreprise' => 'AF Menuiserie',       'note' => '4,9', 'missions' => 162, 'km' => '2,7', 'prix' => 160, 'delai' => null, 'jour' => 'mercredi, 10 h'],
            ['nom' => 'Julien B.',   'entreprise' => 'JB Bois',             'note' => '4,7', 'missions' => 104, 'km' => '4,9', 'prix' => 140, 'delai' => null, 'jour' => 'jeudi, 8 h'],
            ['nom' => 'Serge A.',    'entreprise' => 'Atelier Serge A.',    'note' => '4,8', 'missions' => 288, 'km' => '8,6', 'prix' => 125, 'delai' => null, 'jour' => 'lundi, 9 h'],
        ],

        'montage-de-meubles' => [
            ['nom' => 'Nadir E.',    'entreprise' => 'NE Services',         'note' => '4,7', 'missions' => 211, 'km' => '1,8', 'prix' => 290, 'delai' => null, 'jour' => 'samedi, 9 h'],
            ['nom' => 'Cédric P.',   'entreprise' => 'CP Montage',          'note' => '4,6', 'missions' => 143, 'km' => '3,6', 'prix' => 260, 'delai' => null, 'jour' => 'samedi, 14 h'],
            ['nom' => 'Wassim T.',   'entreprise' => 'WT Aménagement',      'note' => '4,8', 'missions' => 89,  'km' => '6,4', 'prix' => 240, 'delai' => null, 'jour' => 'dimanche, 10 h'],
        ],

        'petits-travaux' => [
            ['nom' => 'Franck O.',   'entreprise' => 'FO Dépannage',        'note' => '4,8', 'missions' => 367, 'km' => '1,1', 'prix' => 75,  'delai' => 25, 'jour' => "aujourd'hui, 16 h"],
            ['nom' => 'Idriss N.',   'entreprise' => 'IN Bricolage',        'note' => '4,6', 'missions' => 152, 'km' => '2,9', 'prix' => 65,  'delai' => 45, 'jour' => 'demain, 9 h'],
            ['nom' => 'Alain V.',    'entreprise' => 'AV Multiservices',    'note' => '4,7', 'missions' => 198, 'km' => '5,7', 'prix' => 60,  'delai' => 70, 'jour' => 'demain, 15 h'],
        ],

        'vitrerie' => [
            ['nom' => 'Sami L.',     'entreprise' => 'SL Vitrerie',         'note' => '4,8', 'missions' => 124, 'km' => '2,1', 'prix' => 190, 'delai' => 30, 'jour' => "aujourd'hui, 17 h"],
            ['nom' => 'Renaud C.',   'entreprise' => 'Chapuis Verre',       'note' => '4,9', 'missions' => 246, 'km' => '4,3', 'prix' => 175, 'delai' => 50, 'jour' => 'demain, 8 h'],
            ['nom' => 'Moussa D.',   'entreprise' => 'MD Miroiterie',       'note' => '4,5', 'missions' => 71,  'km' => '8,8', 'prix' => 160, 'delai' => 80, 'jour' => 'demain, 13 h'],
        ],

    ],

];
