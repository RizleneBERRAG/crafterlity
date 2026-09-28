<?php

/*
|--------------------------------------------------------------------------
| Le contenu du site vitrine
|--------------------------------------------------------------------------
|
| Tout ce qu'un non-developpeur pourrait vouloir corriger vit ici, et nulle
| part ailleurs : les coordonnees, les liens des boutiques, les promesses
| affichees en avant. Les gabarits ne font que mettre en forme ce tableau.
|
| La raison est simple : un site vitrine se modifie dix fois la premiere
| annee — un tarif, un numero, une ville de plus. Si ces valeurs etaient
| ecrites dans les gabarits, chaque correction demanderait de relire du HTML
| et risquerait de casser une mise en page. Ici, on change une chaine.
|
| Les donnees d'identite proviennent du registre : Annuaire des Entreprises,
| Pappers et BODACC, releves le 28 septembre 2026. Elles ne sont pas
| decoratives — elles sont reprises telles quelles dans les mentions
| legales, ou une erreur engage la societe.
|
*/

return [

    /*
    | L'identite. Les mentions legales, la politique de confidentialite et
    | le pied de page lisent ce bloc : une seule source pour des
    | informations qui engagent juridiquement.
    */
    'societe' => [
        'nom'          => 'Crafterlity',
        'raison'       => 'CRAFTERLITY',
        'forme'        => 'SAS',
        'capital'      => '10 000 €',
        'siren'        => '105 409 148',
        'siret'        => '105 409 148 00019',
        'tva'          => 'FR84105409148',
        'rcs'          => 'RCS Lyon',
        'adresse'      => '5 chemin de Gravignan',
        'code_postal'  => '69360',
        'ville'        => 'Ternay',
        'pays'         => 'France',
        'publication'  => 'Alexandrine Simon',  // directrice de la publication
        'email'        => 'contact@crafterlity.com',
        'telephone'    => '07 67 91 45 87',
    ],

    /*
    | Les deux seules adresses qui comptent vraiment sur ce site : l'app se
    | telecharge, elle ne se visite pas. Verifiees le 28 septembre 2026.
    */
    'stores' => [
        'ios'     => 'https://apps.apple.com/fr/app/crafterlity/id6775080793',
        'android' => 'https://play.google.com/store/apps/details?id=com.tinart.crafterlity',
    ],

    /*
    | Les chiffres affiches en avant. Laisses volontairement sobres : une
    | jeune plateforme qui annonce « 10 000 artisans » perd sa credibilite
    | au premier appel. On met en avant ce qui est verifiable.
    */
    'promesses' => [
        [
            'cle'    => '< 1 h',
            'valeur' => "Intervention d'urgence",
            'detail' => "Plomberie, électricité, serrurerie : un technicien proche de chez vous, sans attendre le lendemain.",
        ],
        [
            'cle'    => 'SIRET',
            'valeur' => 'Artisans vérifiés',
            'detail' => "Chaque professionnel est contrôlé auprès de l'INSEE : entreprise réelle, immatriculation à jour.",
        ],
        [
            'cle'    => '0 €',
            'valeur' => 'Pour les particuliers',
            'detail' => "Publier une demande et recevoir des propositions ne coûte rien. Vous ne payez que l'intervention.",
        ],
        [
            'cle'    => 'Stripe',
            'valeur' => 'Paiement sécurisé',
            'detail' => "Le règlement passe par l'application. L'artisan est versé une fois la mission terminée.",
        ],
    ],

];
