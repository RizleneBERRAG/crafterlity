<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Les trois pages qui engagent.
 *
 * Elles partagent un gabarit de lecture — colonne etroite, encre sur
 * papier, titres numerotes — parce qu'elles se lisent toutes de la meme
 * facon : longtemps, et souvent le jour ou quelque chose s'est mal passe.
 *
 * La date de mise a jour est passee par le controleur et non ecrite dans
 * le gabarit : c'est la premiere chose qu'un lecteur verifie, et la
 * derniere qu'on pense a corriger.
 */
class LegalController extends Controller
{
    public function mentions(): View
    {
        return view('pages.legal.mentions', ['maj' => '28 septembre 2026']);
    }

    public function cgu(): View
    {
        return view('pages.legal.cgu', ['maj' => '28 septembre 2026']);
    }

    public function confidentialite(): View
    {
        /* Reprise de la politique publiee sur crafterlity.com au
           2 juin 2026 : la date d'origine est conservee, le site vitrine ne
           fait que la remettre en forme. La modifier reviendrait a dater
           d'aujourd'hui un texte dont le contenu n'a pas change. */
        return view('pages.legal.confidentialite', ['maj' => '2 juin 2026']);
    }
}
