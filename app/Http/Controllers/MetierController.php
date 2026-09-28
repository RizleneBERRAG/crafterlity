<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Les pages metier — la partie du site qui va chercher les visiteurs.
 *
 * Personne ne tape « plateforme de mise en relation avec des artisans ».
 * On tape « plombier Lyon fuite » ou « serrurier porte claquee ». Une page
 * par metier, c'est une porte d'entree par intention de recherche, et
 * c'est exactement ce qui manque au site actuel.
 */
class MetierController extends Controller
{
    public function index(): View
    {
        return view('pages.metiers.index', [
            'metiers' => config('metiers'),
        ]);
    }

    public function show(string $slug): View
    {
        $metier = $this->trouver($slug);

        /* Les metiers voisins, en bas de page. Le hasard serait plus simple
           mais moins utile : on preserve l'ordre du catalogue, qui va du
           plus demande au plus rare. */
        $voisins = collect(config('metiers'))
            ->reject(fn (array $m) => $m['slug'] === $slug)
            ->take(3);

        return view('pages.metiers.show', compact('metier', 'voisins'));
    }

    /**
     * Un slug absent du catalogue est une 404, pas une page vide.
     *
     * Sans ce controle, /services/nimportequoi renverrait un gabarit sans
     * contenu et en HTTP 200 — un moteur l'indexerait comme une vraie page,
     * et le site se remplirait d'adresses creuses.
     */
    private function trouver(string $slug): array
    {
        $metier = collect(config('metiers'))->firstWhere('slug', $slug);

        if (! $metier) {
            throw new NotFoundHttpException("Metier inconnu : {$slug}");
        }

        return $metier;
    }
}
