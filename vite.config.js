import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

/*
 * Pas de Tailwind : la charte « Nuit d'intervention » vit dans
 * resources/css/app.css, ecrite a la main. Sur un site vitrine d'une
 * quinzaine de pages qui partagent une dizaine de composants, un cadre
 * utilitaire ajoute une dependance et une etape de compilation pour
 * remplacer une feuille de 700 lignes qu'on lit d'un bout a l'autre.
 *
 * Deux feuilles : app.css pose la matiere — papier, encre, filets, chasse
 * fixe — et mouvement.css pose ce qui bouge. Les separer n'est pas un
 * caprice : la regle « un document se remplit, il ne flotte pas » se relit
 * d'un bloc quand elle n'est pas diluee dans sept cents lignes de mise en
 * page.
 *
 * Pas de plugin de polices non plus : les fichiers woff2 sont dans
 * public/fonts. Aucun appel a un domaine tiers, donc aucun visiteur trace
 * avant meme d'avoir vu la page — ce qui evite au passage d'avoir a le
 * declarer dans la politique de confidentialite.
 */
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/mouvement.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
