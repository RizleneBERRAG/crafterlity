<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Les garde-fous du site vitrine.
 *
 * Ils ne cherchent pas a couvrir chaque ligne : ils verrouillent les trois
 * choses qui, si elles cassent, cassent le site pour un visiteur.
 *
 *   1. Toutes les pages repondent. Un site vitrine de vingt-trois adresses
 *      se casse silencieusement : une cle de tableau renommee dans un
 *      fichier de configuration fait tomber une page que personne ne
 *      rouvre avant trois semaines.
 *   2. Le formulaire de contact enregistre, valide, et ecarte les robots.
 *   3. Le plan du site contient tous les metiers.
 */
class SiteTest extends TestCase
{
    use RefreshDatabase;

    /** Toutes les pages publiques repondent en 200. */
    public function test_les_pages_repondent(): void
    {
        $routes = [
            'accueil', 'methode', 'urgence', 'artisans', 'telecharger',
            'questions', 'contact', 'metiers.index',
            'legal.mentions', 'legal.cgu', 'legal.confidentialite',
            'sitemap', 'robots',
        ];

        foreach ($routes as $nom) {
            $this->get(route($nom))->assertOk();
        }
    }

    /** Chaque metier du catalogue a une page qui repond. */
    public function test_chaque_metier_a_sa_page(): void
    {
        foreach (config('metiers') as $metier) {
            $this->get(route('metiers.show', $metier['slug']))
                ->assertOk()
                ->assertSee($metier['nom'], false);
        }
    }

    /**
     * Un slug inconnu renvoie 404, pas une page vide en 200.
     *
     * Sans ce controle, le site se remplirait d'adresses creuses qu'un
     * moteur indexerait comme de vraies pages.
     */
    public function test_un_metier_inconnu_renvoie_404(): void
    {
        $this->get('/services/nimporte-quoi')->assertNotFound();
    }

    /**
     * Le catalogue ne doit contenir que des cles ASCII.
     *
     * Ce test existe parce que le bug s'est produit : une passe
     * d'accentuation automatique avait transforme la cle 'requete' en
     * 'requête', et la page metier tombait en erreur 500. Une cle de
     * tableau est du code, pas du texte affiche.
     */
    public function test_les_cles_de_configuration_sont_en_ascii(): void
    {
        foreach ([config('metiers'), config('parcours.client'), config('parcours.pro')] as $tableau) {
            foreach ($tableau as $entree) {
                foreach (array_keys($entree) as $cle) {
                    $this->assertSame(
                        $cle,
                        preg_replace('/[^\x20-\x7E]/', '', $cle),
                        "La cle « {$cle} » contient un caractere accentue."
                    );
                }
            }
        }
    }

    /** Un message valide est enregistre et confirme au visiteur. */
    public function test_le_formulaire_enregistre_un_message(): void
    {
        $this->post(route('contact.store'), [
            'nom'     => 'Rizlene Berrag',
            'email'   => 'contact@example.com',
            'sujet'   => 'professionnel',
            'message' => "Bonjour, je vous contacte au sujet d'une intervention de plomberie.",
        ])->assertRedirect(route('contact'))->assertSessionHas('ok');

        $this->assertDatabaseCount('messages', 1);
        $this->assertDatabaseHas('messages', ['email' => 'contact@example.com']);
    }

    /** Un message incomplet est refuse, et rien n'est enregistre. */
    public function test_le_formulaire_refuse_un_message_incomplet(): void
    {
        $this->post(route('contact.store'), [
            'nom'     => 'A',
            'email'   => 'pas-une-adresse',
            'sujet'   => 'particulier',
            'message' => 'court',
        ])->assertSessionHasErrors(['nom', 'email', 'message']);

        $this->assertDatabaseCount('messages', 0);
    }

    /**
     * Le piege a robots : la reponse est un succes, mais rien n'est ecrit.
     *
     * Annoncer le rejet apprendrait au robot a contourner le piege.
     */
    public function test_le_piege_a_robots_ecarte_sans_le_dire(): void
    {
        $this->post(route('contact.store'), [
            'nom'     => 'Robot',
            'email'   => 'spam@example.com',
            'sujet'   => 'autre',
            'message' => 'Message publicitaire automatique envoye en nombre.',
            'societe' => 'Une valeur quelconque',   // le champ invisible
        ])->assertRedirect(route('contact'));

        $this->assertDatabaseCount('messages', 0);
    }

    /** Le plan du site liste toutes les pages metier. */
    public function test_le_plan_du_site_liste_les_metiers(): void
    {
        $reponse = $this->get(route('sitemap'))
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=utf-8');

        foreach (config('metiers') as $metier) {
            $reponse->assertSee(route('metiers.show', $metier['slug']), false);
        }
    }

    /** Le fichier robots ouvre le site et pointe vers le plan. */
    public function test_le_fichier_robots_pointe_vers_le_plan(): void
    {
        $this->get(route('robots'))
            ->assertOk()
            ->assertSee('Sitemap: '.route('sitemap'), false);
    }

    /**
     * Les pages legales existent et nomment l'editeur.
     *
     * C'est l'obligation de l'article 6-III de la LCEN, et c'est ce qui
     * manque aujourd'hui au site en ligne.
     */
    public function test_les_mentions_legales_nomment_l_editeur(): void
    {
        $this->get(route('legal.mentions'))
            ->assertOk()
            ->assertSee(config('crafterlity.societe.raison'), false)
            ->assertSee(config('crafterlity.societe.siren'), false)
            ->assertSee(config('crafterlity.societe.publication'), false);
    }

    /** Chaque page porte un titre et une description uniques. */
    public function test_chaque_page_a_sa_description(): void
    {
        $vues = [];

        foreach (['accueil', 'methode', 'urgence', 'artisans', 'telecharger', 'questions', 'contact'] as $nom) {
            $html = $this->get(route($nom))->assertOk()->getContent();

            preg_match('/<meta name="description" content="([^"]*)"/', $html, $m);
            $this->assertNotEmpty($m[1] ?? '', "La page « {$nom} » n'a pas de description.");
            $this->assertNotContains($m[1], $vues, "La page « {$nom} » reprend une description deja utilisee.");

            $vues[] = $m[1];
        }
    }

    /**
     * La feuille de polices declare des chemins RELATIFS.
     *
     * Ce test existe parce que le bug s'est produit : les chemins etaient
     * ecrits « /fonts/archivo-latin.woff2 », ce qui ne vaut que si le site
     * occupe la racine du domaine. Sous XAMPP, il est servi depuis
     * /crafterlity/public/ et les cinq fichiers repondaient 404 — sans la
     * moindre erreur visible, la page basculant sur les polices du systeme.
     */
    public function test_les_polices_ont_des_chemins_relatifs(): void
    {
        $css = file_get_contents(public_path('fonts/fonts.css'));

        $this->assertStringNotContainsString(
            'url("/',
            $css,
            'Un chemin absolu casse les polices des que le site vit dans un sous-repertoire.'
        );

        preg_match_all('/url\("([^"]+)"\)/', $css, $trouves);
        $this->assertNotEmpty($trouves[1], 'Aucune police declaree.');

        foreach ($trouves[1] as $fichier) {
            $this->assertFileExists(public_path('fonts/'.$fichier));
        }
    }
}
