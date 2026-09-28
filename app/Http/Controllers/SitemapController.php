<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

/**
 * Le plan du site et le fichier robots, servis par l'application.
 *
 * Deux fichiers statiques auraient suffi — a condition de ne jamais
 * changer de domaine, de ne jamais ajouter de metier, et de penser a les
 * corriger a chaque fois. Genere ici, le plan suit le catalogue : un
 * metier ajoute dans config/metiers.php y apparait sans qu'on y touche.
 */
class SitemapController extends Controller
{
    public function sitemap(): Response
    {
        /*
         * La priorite n'est pas une note de qualite : c'est l'importance
         * RELATIVE des pages entre elles, pour un moteur qui doit choisir
         * par ou commencer. L'accueil et les pages metier passent devant ;
         * les pages legales ferment la marche, sans etre exclues — elles
         * rassurent, et on les cherche parfois directement.
         */
        $pages = [
            ['accueil', '1.0', 'weekly'],
            ['metiers.index', '0.9', 'monthly'],
            ['urgence', '0.9', 'monthly'],
            ['artisans', '0.9', 'monthly'],
            ['methode', '0.8', 'monthly'],
            ['telecharger', '0.8', 'monthly'],
            ['questions', '0.7', 'monthly'],
            ['contact', '0.6', 'yearly'],
            ['legal.mentions', '0.2', 'yearly'],
            ['legal.cgu', '0.2', 'yearly'],
            ['legal.confidentialite', '0.2', 'yearly'],
        ];

        $urls = [];

        foreach ($pages as [$route, $priorite, $frequence]) {
            $urls[] = ['loc' => route($route), 'priority' => $priorite, 'changefreq' => $frequence];
        }

        foreach (config('metiers') as $metier) {
            $urls[] = [
                'loc'        => route('metiers.show', $metier['slug']),
                'priority'   => '0.8',
                'changefreq' => 'monthly',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml; charset=utf-8');
    }

    public function robots(): Response
    {
        /*
         * Tout est ouvert : un site vitrine n'a rien a cacher a un moteur.
         * La seule ligne utile est celle du plan — en adresse absolue,
         * comme la norme l'exige.
         */
        $lignes = implode("\n", [
            'User-agent: *',
            'Allow: /',
            '',
            'Sitemap: '.route('sitemap'),
            '',
        ]);

        return response($lignes, 200)->header('Content-Type', 'text/plain; charset=utf-8');
    }
}
