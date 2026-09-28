<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Les pages qui n'ont pas de donnee propre : elles composent le contenu
 * des fichiers de configuration et le passent a leur gabarit.
 *
 * Le controleur ne contient aucun texte. C'est volontaire : le jour ou une
 * phrase doit changer, on la cherche dans config/, pas dans une classe PHP
 * au milieu d'un appel a view().
 */
class PageController extends Controller
{
    public function accueil(): View
    {
        return view('pages.accueil', [
            'metiers'   => collect(config('metiers'))->take(6),
            'urgences'  => collect(config('metiers'))->where('urgence', true),
            'promesses' => config('crafterlity.promesses'),
            'etapes'    => config('parcours.client'),
            /* Seules les questions de particuliers apparaissent sur
               l'accueil : un artisan qui cherche ses conditions passe par
               /artisans, ou il retrouve les siennes. Melanger les deux
               publics sur la page d'entree, c'est repondre a cote pour
               tout le monde. */
            'faq'       => collect(config('parcours.faq'))->where('public', 'client')->take(5),
        ]);
    }

    public function methode(): View
    {
        return view('pages.methode', [
            'etapes'  => config('parcours.client'),
            'metiers' => config('metiers'),
            'faq'     => collect(config('parcours.faq'))->where('public', 'client'),
        ]);
    }

    public function urgence(): View
    {
        return view('pages.urgence', [
            'urgences' => collect(config('metiers'))->where('urgence', true),
            'zone'     => config('parcours.zone'),
        ]);
    }

    public function artisans(): View
    {
        return view('pages.artisans', [
            'etapes'  => config('parcours.pro'),
            'metiers' => config('metiers'),
            'faq'     => collect(config('parcours.faq'))->where('public', 'pro'),
        ]);
    }

    public function telecharger(): View
    {
        return view('pages.telecharger');
    }

    public function questions(): View
    {
        /* La FAQ complete, groupee par public. groupBy conserve l'ordre du
           tableau source : les questions de particuliers restent devant,
           ce qui correspond a la proportion des visiteurs. */
        return view('pages.questions', [
            'groupes' => collect(config('parcours.faq'))->groupBy('public'),
        ]);
    }
}
