<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Un message recu par le formulaire de contact.
 *
 * Le modele est volontairement nu : pas de relation, pas de portee, pas
 * d'accesseur. Un message de contact n'a pas de cycle de vie — il arrive,
 * on y repond, on l'archive.
 */
class Message extends Model
{
    /**
     * Les quatre champs du formulaire, et eux seuls.
     *
     * La liste est blanche, jamais noire : un champ ajoute au formulaire
     * demain ne sera pas enregistre tant qu'il n'aura pas ete ajoute ici.
     * C'est exactement la protection recherchee.
     */
    protected $fillable = ['nom', 'email', 'sujet', 'message'];
}
