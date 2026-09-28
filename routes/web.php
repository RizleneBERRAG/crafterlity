<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Les adresses du site
|--------------------------------------------------------------------------
|
| Elles sont en francais, lisibles, et sans identifiant technique : une
| adresse se lit a voix haute au telephone, se recopie sur une carte de
| visite et s'affiche dans un resultat de recherche. /services/plomberie
| dit ce qu'il contient ; /p?id=4 ne dit rien a personne.
|
| Toutes portent un nom. Aucun gabarit du site n'ecrit une adresse en dur :
| le jour ou /questions devient /faq, une ligne change ici et les quarante
| liens du site suivent.
|
*/

Route::get('/', [PageController::class, 'accueil'])->name('accueil');

Route::get('/comment-ca-marche', [PageController::class, 'methode'])->name('methode');
Route::get('/urgence',           [PageController::class, 'urgence'])->name('urgence');
Route::get('/artisans',          [PageController::class, 'artisans'])->name('artisans');
Route::get('/telecharger',       [PageController::class, 'telecharger'])->name('telecharger');
Route::get('/questions',         [PageController::class, 'questions'])->name('questions');

/*
 * Les metiers. La page d'index liste, la page de detail vend. Le parametre
 * est le slug du tableau config/metiers.php : le controleur refuse tout ce
 * qui n'y figure pas, donc aucune adresse inventee ne renvoie une page
 * vide — elle renvoie une 404, ce qui est la bonne reponse.
 */
Route::get('/services',        [MetierController::class, 'index'])->name('metiers.index');
Route::get('/services/{slug}', [MetierController::class, 'show'])->name('metiers.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,60')   // 5 messages par heure et par adresse IP
    ->name('contact.store');

/*
 * Les pages qui engagent juridiquement. Elles manquent aujourd'hui a
 * crafterlity.com, qui n'expose qu'une politique de confidentialite : pour
 * un service qui encaisse des paiements et met en relation des
 * professionnels avec des particuliers, les mentions legales (LCEN,
 * article 6-III) et des conditions generales sont obligatoires.
 */
Route::get('/mentions-legales',     [LegalController::class, 'mentions'])->name('legal.mentions');
Route::get('/conditions-generales', [LegalController::class, 'cgu'])->name('legal.cgu');
Route::get('/confidentialite',      [LegalController::class, 'confidentialite'])->name('legal.confidentialite');

/*
 * Sitemap et robots.txt servis par l'application : la directive Sitemap
 * exige une adresse absolue, qu'un fichier statique figerait sur le domaine
 * du jour ou il a ete ecrit. Ici, elle suit APP_URL.
 */
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt',  [SitemapController::class, 'robots'])->name('robots');
