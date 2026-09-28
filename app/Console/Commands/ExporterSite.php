<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Copie statique du site, pour GitHub Pages.
 *
 * GitHub Pages ne sert que des fichiers : ni PHP, ni base de donnees. Cette
 * copie montre donc les pages telles qu'elles sont, mais le formulaire de
 * contact ne peut rien enregistrer — il est desactive visiblement plutot que
 * laisse echouer en silence.
 *
 * Tout le reste continue de fonctionner, parce que tout le reste est cote
 * navigateur : le simulateur de demande, le filtre des metiers, les onglets
 * de captures, la FAQ, la jauge de lecture et le temoin de section.
 */
class ExporterSite extends Command
{
    protected $signature = 'site:exporter
        {--base= : Adresse publique finale, ex. https://rizleneberrag.github.io/crafterlity}
        {--source=http://localhost/crafterlity/public : Adresse locale a parcourir}
        {--vers=docs : Dossier de destination, relatif a la racine du projet}';

    protected $description = 'Exporte une copie statique du site';

    /** Dossiers de public/ a recopier tels quels. */
    private const ASSETS = ['build', 'images', 'fonts'];

    public function handle(): int
    {
        $base = rtrim((string) $this->option('base'), '/');
        $source = rtrim((string) $this->option('source'), '/');
        $vers = base_path((string) $this->option('vers'));

        if ($base === '') {
            $this->error('Indiquez --base, l’adresse publique finale : les liens et les images en dépendent.');

            return self::FAILURE;
        }

        if (! $this->siteRepond($source)) {
            $this->error("Le site ne répond pas sur {$source}. Apache est-il démarré ?");

            return self::FAILURE;
        }

        File::deleteDirectory($vers);
        File::ensureDirectoryExists($vers);

        $pages = $this->pages();
        $this->info(count($pages).' page(s) à exporter.');

        $barre = $this->output->createProgressBar(count($pages));
        $barre->start();

        foreach ($pages as $chemin => $destination) {
            // ignore_errors : la page 404 repond justement par un code 404, et
            // sans cela file_get_contents renonce au lieu de rendre le corps.
            $html = @file_get_contents($source.$chemin, false, stream_context_create([
                'http' => ['timeout' => 20, 'ignore_errors' => true],
            ]));

            if ($html === false) {
                $barre->clear();
                $this->warn("  {$chemin} : pas de réponse, ignorée.");
                $barre->display();

                continue;
            }

            $fichier = $vers.'/'.$destination;
            File::ensureDirectoryExists(dirname($fichier));

            // Le sitemap et le robots.txt ne sont pas du HTML : ils n'ont
            // besoin que de la reecriture des adresses.
            File::put($fichier, str_ends_with($destination, '.html')
                ? $this->preparer($html, $source, $base)
                : str_replace($source, $base, $html));

            $barre->advance();
        }

        $barre->finish();
        $this->newLine(2);

        foreach (self::ASSETS as $dossier) {
            File::copyDirectory(public_path($dossier), $vers.'/'.$dossier);
            $this->line("  {$dossier}/ recopié");
        }

        File::copy(public_path('favicon.ico'), $vers.'/favicon.ico');

        // Sans ce fichier, GitHub Pages passe le site dans Jekyll, qui ignore
        // tout dossier commencant par un souligne et peut casser des chemins.
        File::put($vers.'/.nojekyll', '');
        $this->line('  .nojekyll écrit');

        /*
         * L'apercu ne doit jamais etre indexe. Deux raisons, et la seconde
         * suffirait : il ferait doublon avec crafterlity.com, et les deux y
         * perdraient ; surtout, il contient des donnees de simulation, un
         * projet de conditions generales non valide et des mentions legales
         * incompletes. Rien de tout cela n'a a se retrouver dans un moteur.
         *
         * Le robots.txt ferme la porte, la balise de chaque page la verrouille
         * — un moteur qui arrive par un lien partage ne lit pas le robots.txt
         * du site, mais il lit la balise.
         */
        File::put($vers.'/robots.txt', "User-agent: *\nDisallow: /\n");
        $this->line('  robots.txt de l’aperçu : indexation refusée');

        $this->newLine();
        $this->info('Copie prête dans '.$this->option('vers').'/');
        $this->line('  Adresse de publication : '.$base);

        return self::SUCCESS;
    }

    private function siteRepond(string $source): bool
    {
        $contexte = stream_context_create(['http' => ['timeout' => 10, 'ignore_errors' => true]]);

        return @file_get_contents($source.'/robots.txt', false, $contexte) !== false;
    }

    /**
     * Les pages a parcourir, et ou les ecrire.
     *
     * GitHub Pages sert /services/ depuis /services/index.html : chaque page a
     * donc son propre dossier, ce qui garde les adresses identiques a celles du
     * site complet. Un lien partage aujourd'hui restera valable le jour de la
     * vraie mise en ligne.
     *
     * @return array<string,string>
     */
    private function pages(): array
    {
        $pages = [
            '/'                     => 'index.html',
            '/services'             => 'services/index.html',
            '/comment-ca-marche'    => 'comment-ca-marche/index.html',
            '/urgence'              => 'urgence/index.html',
            '/artisans'             => 'artisans/index.html',
            '/telecharger'          => 'telecharger/index.html',
            '/questions'            => 'questions/index.html',
            '/contact'              => 'contact/index.html',
            '/mentions-legales'     => 'mentions-legales/index.html',
            '/conditions-generales' => 'conditions-generales/index.html',
            '/confidentialite'      => 'confidentialite/index.html',
            '/sitemap.xml'          => 'sitemap.xml',
            // GitHub Pages sert ce fichier pour toute adresse inconnue.
            '/adresse-inconnue'     => '404.html',
        ];

        // Les dix pages metier viennent du catalogue : en ajouter une au
        // fichier de configuration suffit a la voir apparaitre dans l'apercu.
        foreach (config('metiers') as $metier) {
            $pages['/services/'.$metier['slug']] = 'services/'.$metier['slug'].'/index.html';
        }

        return $pages;
    }

    /**
     * Reecrit les adresses et neutralise ce qui ne peut pas fonctionner.
     */
    private function preparer(string $html, string $source, string $base): string
    {
        $html = str_replace($source, $base, $html);

        // Voir le robots.txt ecrit plus haut : cet apercu ne s'indexe pas.
        $html = preg_replace(
            '/<head>/i',
            "<head>\n    <meta name=\"robots\" content=\"noindex, nofollow\">",
            $html,
            1
        );

        /*
         * Le formulaire de contact enregistre en base : sans serveur, il ne
         * peut rien faire. Le desactiver visiblement vaut mieux que de le
         * laisser echouer sans explication — un visiteur qui ecrit un message
         * et ne recoit jamais de reponse est pire qu'un formulaire ferme.
         */
        $html = preg_replace(
            '/<form\b([^>]*)method="post"([^>]*)>/i',
            '<form$1method="post"$2 onsubmit="return false" data-apercu="1">',
            $html
        );

        $html = preg_replace(
            '/<button([^>]*)type="submit"([^>]*)>/i',
            '<button$1type="submit"$2 disabled>',
            $html
        );

        $note = '<p class="message ko" style="margin-top:4px">'
            .'<strong>Aperçu statique :</strong> ce formulaire n’enregistre rien. '
            .'Écrivez à contact@crafterlity.com ou appelez le 07 67 91 45 87.'
            .'</p>';

        return str_replace('</form>', $note.'</form>', $html);
    }
}
