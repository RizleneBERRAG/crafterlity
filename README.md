# Crafterlity — site vitrine

Maquette fonctionnelle proposée à CRAFTERLITY (SIREN 105 409 148, Ternay),
éditeur de l'application mobile Crafterlity. Site complet en Laravel, pas une
image de présentation : toutes les pages existent, le formulaire fonctionne,
les tests passent.

---

## Pourquoi ce site

Au 28 septembre 2026, **crafterlity.com ne comptait que trois pages** —
l'accueil, la politique de confidentialité et une page de support. C'est la
coquille minimale qu'Apple et Google exigent pour valider une application ;
ce n'est pas un site.

Ce qui manquait, et que ce projet apporte :

| Manque constaté | Réponse |
|---|---|
| Aucun lien vers l'App Store ni Google Play | Liens sur toutes les pages, plus une page dédiée |
| Aucune page expliquant le service | Accueil, parcours client, parcours artisan, page urgence |
| Aucune page par métier | Dix pages, une par spécialité — les portes d'entrée du référencement |
| Pas de mentions légales | Rédigées (obligation LCEN art. 6-III) |
| Pas de conditions générales | Projet complet, à faire valider par un juriste |
| Ni `robots.txt` ni `sitemap.xml` | Générés par l'application, à jour automatiquement |
| Aucune donnée structurée | Organization, SoftwareApplication, Service, FAQPage, HowTo |
| Aucun moyen de contact hors courriel | Formulaire avec validation, anti-robots et enregistrement |

---

## Aperçu en ligne

**https://rizleneberrag.github.io/crafterlity**

Copie statique servie par GitHub Pages depuis `docs/`, régénérée par une
commande :

```powershell
php artisan serve --port=8123
php artisan site:exporter --base=https://rizleneberrag.github.io/crafterlity
```

Elle parcourt le site servi en local, réécrit les adresses, recopie les
assets et écrit `docs/`. Chaque page a son propre dossier (`services/plomberie/index.html`),
donc **un lien partagé aujourd'hui restera valable le jour de la vraie mise
en ligne**.

Ce qui change dans l'aperçu, et seulement cela :

- **Le formulaire de contact est désactivé** — GitHub Pages ne sert que des
  fichiers, il n'y a ni PHP ni base. Il est fermé visiblement plutôt que
  laissé échouer en silence : un visiteur qui écrit un message et n'obtient
  jamais de réponse est pire qu'un formulaire fermé.
- **L'indexation est refusée**, par `robots.txt` et par une balise `noindex`
  sur chaque page. L'aperçu ferait doublon avec crafterlity.com, et surtout
  il contient des données de simulation, un projet de CGU non validé et des
  mentions légales incomplètes. Rien de tout cela n'a à se retrouver dans un
  moteur de recherche.

Tout le reste fonctionne, parce que tout le reste est côté navigateur : le
simulateur, le filtre des métiers, les onglets, la FAQ, la jauge de lecture
et le témoin de section.

## Mise en route

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Le projet vise **PHP 8.2**, la version livrée avec XAMPP — celle qu'Apache
utilisera. Si `php -v` affiche autre chose dans votre terminal, c'est qu'un
autre binaire passe devant dans le `PATH` (Herd, par exemple) : appelez alors
`C:\xampp\php\php.exe` explicitement.

Base SQLite par défaut : aucun serveur de base de données à installer.

Le site fonctionne aussi tel quel derrière Apache, à
`http://localhost/crafterlity/public/`. Les chemins d'assets et de polices
sont relatifs : ils valent à la racine d'un domaine comme dans un
sous-répertoire.

```powershell
php artisan test     # 19 tests
npm run dev          # rechargement à chaud pendant le développement
```

> PowerShell n'accepte pas `&&` comme séparateur d'instructions : écrivez
> `cd chemin` puis `php artisan serve` sur deux lignes, ou séparez-les
> par `;`.

---

## Ce qu'il y a dedans

**23 adresses**, toutes en français et sans identifiant technique.

```
/                          accueil
/services                  les dix métiers
/services/{métier}         une page par métier (plomberie, électricité…)
/comment-ca-marche         le parcours client, et ce qu'on paie
/urgence                   l'intervention immédiate, et ses limites
/artisans                  l'espace professionnel
/telecharger               les deux boutiques
/questions                 la FAQ, par public
/contact                   formulaire + coordonnées
/mentions-legales          /conditions-generales   /confidentialite
/sitemap.xml               /robots.txt
```

**Le contenu vit dans `config/`**, pas dans les gabarits :

- `config/crafterlity.php` — identité de la société, liens des boutiques, promesses
- `config/metiers.php` — les dix métiers et leurs interventions
- `config/parcours.php` — les étapes, la FAQ, la zone couverte

Changer un numéro de téléphone, ajouter un métier ou corriger une réponse de
FAQ se fait dans un de ces trois fichiers. Aucun HTML à relire.

---

## La charte : « Bon d'intervention »

Une première version reprenait la charte de l'application — fond bleu nuit,
or, halos lumineux, boutons en gélule. Elle a été abandonnée : sombre + or +
lueurs est la grammaire visuelle des pages de crypto et de dropshipping. Un
visiteur qui cherche un artisan arrive méfiant ; une plateforme qui doit
prouver qu'elle n'est pas une arnaque n'a pas le droit d'en avoir l'air.

Le site prend donc la forme de ce qu'il vend : **un document de chantier**.

- **Papier et encre.** Fond clair, encre `#14122E` — le bleu nuit de
  l'application, employé comme couleur de texte. La continuité de marque est
  gardée, l'effet « page dorée » a disparu.
- **Le filet.** Seul ornement du site. Il borde les sections, sépare les
  cellules d'une grille, souligne un intitulé. Là où une autre charte poserait
  une carte avec un rayon et une ombre, celle-ci pose un trait d'un pixel.
- **La donnée en chasse fixe.** Références, SIREN, délais, prix et codes
  postaux sont composés en Plex Mono. C'est ce détail qui fait passer la page
  du registre publicitaire au registre documentaire.
- **Les références de section** (`RÉF. 01 — DEMANDE`) sont numérotées par un
  compteur CSS : rien à écrire dans les gabarits, et la numérotation reste
  juste le jour où une section s'ajoute.

Aucun dégradé, aucune ombre portée, aucune animation d'apparition. Le rouge
ne sert qu'à l'urgence.

### Ce qui bouge

La première version de cette charte s'interdisait toute animation. La page
était juste, et morte. Le mouvement est revenu, mais il obéit à la même
logique que le reste : **un document se remplit, il ne flotte pas.**

Tout mouvement du site appartient à l'une de ces quatre familles, et à
aucune autre :

| | |
|---|---|
| **Le tracé** | un filet passe de rien à toute sa longueur |
| **La frappe** | un texte s'écrit caractère par caractère |
| **Le défilé** | un nombre monte jusqu'à sa valeur |
| **L'impression** | un bloc se découvre du haut vers le bas, sans fondu |

Bannis : le rebond, le fondu enchaîné, le zoom, la rotation décorative, le
flottement, le parallaxe. Chacun dit « site vitrine animé » ; aucun ne dit
« intervention en cours ». Les durées tiennent entre 200 et 400 ms et les
courbes sont presque linéaires — une machine n'a pas d'élan.

Trois garde-fous valent pour chaque module :

- l'état de départ est posé par le **script**, jamais par la feuille de
  style. Sans JavaScript, rien n'est jamais masqué ;
- « mouvement réduit » demandé : tout s'affiche d'un coup, et rien ne se
  perd ;
- aucune information n'existe uniquement dans une animation.

En pratique : les sections s'impriment à l'arrivée, le filet d'en-tête se
trace, la jauge de lecture se remplit sous le bandeau, la **référence de la
section en cours** s'affiche dans la barre de navigation (`RÉF. 03 —
L'URGENCE`), les chiffres du relevé défilent, la page des services se filtre
à la frappe, et le téléphone de l'accueil change d'écran par onglets.

### La prestance : ce qui distingue ce site des autres

Le vrai risque n'était pas de faire laid, c'était de faire **le quatrième**.
Travaux.com, StarOfService, AlloVoisins emploient la même grammaire : cartes
arrondies, accent vif, illustrations, photos de gens qui sourient. En rester
là, c'est ressembler à tout le monde — et sur un marché où le visiteur arrive
méfiant, ressembler à tout le monde c'est ressembler au pire.

Le parti est donc d'aller où aucun d'eux ne va : le site a la tenue d'un
**document**, pas d'une page de vente. Trois pièces le posent.

**Le cartouche** ouvre la page, avant même le titre : éditeur, immatriculation,
établissement, objet. C'est l'en-tête d'un imprimé officiel. Chaque valeur est
vraie et se vérifie en trente secondes sur l'annuaire des entreprises — et
c'est exactement ce qu'on veut qu'un visiteur méfiant fasse.

**Le tampon** atteste, il n'annonce pas. C'est la différence entre un contrôle
auprès de l'INSEE et une pastille « certifié » qu'on se décerne soi-même — les
badges de confiance sont précisément ce qui fait douter. Il est posé **une
seule fois**, sur l'angle du téléphone, et légèrement de travers : un tampon
posé à la main l'est toujours.

**Le colophon** ferme le document comme le cartouche l'ouvrait : qui l'a
établi, sous quelle forme juridique, sous quel numéro.

S'y ajoute **le comparateur** — le même mardi matin raconté deux fois, avec
l'heure en marge. Pas de tableau à croix rouges et coches vertes : ce
dispositif-là est le signe d'un argumentaire, il se lit comme une publicité et
se discute ligne par ligne. Deux récits horodatés ne se discutent pas. Chacun
reconnaît sa propre matinée dans la colonne de gauche et conclut seul — et une
conclusion qu'on tire soi-même est la seule qu'on garde. **2 j 6 h** contre
**26 min**.

### Le simulateur de demande

C'est le seul endroit du site où le visiteur **fait** quelque chose au lieu
de lire. Il choisit un métier, voit la description s'écrire, coche l'urgence,
publie la demande — puis les offres arrivent une à une, avec un prix, une
note, une distance et un délai. Il en accepte une, et suit le trajet : un plan
schématique se dessine, le point rouge avance jusqu'à l'adresse, le compte à
rebours descend, les jalons se cochent, le paiement se confirme.

Trois captures d'écran ne diront jamais ce que dit une offre qui arrive sous
les yeux. Pour une plateforme de mise en relation, c'est la différence entre
expliquer et montrer.

Les données vivent dans `config/simulation.php`, et le composant annonce
**deux fois**, en tête et en clair, qu'il s'agit de données d'exemple. Sur un
site dont tout l'enjeu est de ne pas ressembler à une arnaque, faire passer
des artisans fictifs pour réels serait exactement l'erreur à ne pas commettre.

Sans JavaScript, le bloc reste un sommaire : les dix jetons sont des liens
vers les pages métier.

### Les photographies

Le site n'en avait aucune, et c'est ce qui le faisait paraître froid — « un
projet d'école », « trop robotisé ». Une plateforme qui envoie quelqu'un chez
vous ne peut pas être entièrement composée de filets et de chiffres.

Dix photographies ont été **générées sur mesure**, puis étalonnées.
Le parti tient en trois interdits : aucun visage tourné vers l'objectif,
aucun sourire commandé, aucune image « lifestyle » où une famille heureuse
regarde un artisan visser une étagère — c'est le vocabulaire exact du site
d'arnaque. On montre le travail : des mains, des outils, un chantier.

Toutes ont reçu le **même étalonnage** (`resources/` → voir le commentaire de
`.photo` dans `app.css`) : saturation à 55 %, balance réchauffée pour annuler
la dominante bleu-vert, noirs levés vers l'encre de la page plutôt que vers
le noir pur. Ce n'est pas la beauté de chaque image qui fait une direction
artistique, c'est le fait qu'elles aient toutes subi le même traitement.

Elles paraissent à trois endroits seulement : en bandeau sur chacune des dix
pages métier, en bande pleine largeur sur l'accueil, et sur la page artisans.
**À remplacer par les vraies photos de Crafterlity** dès qu'ils en auront.

### Ce qui a été dé-robotisé

Une version intermédiaire appliquait son parti trop systématiquement — le
défaut du projet d'école : on applique un procédé partout pour prouver qu'on
a un procédé.

- **Les « RÉF. 01 — » ont disparu.** Un numéro en chasse fixe devant chaque
  section, sept fois par page. Un document numérote ses articles parce qu'on
  s'y réfère ; personne ne dit « voyez la référence 03 » d'une page d'accueil.
- **La chasse fixe est rendue aux données.** Elle était partout : intitulés,
  fil d'Ariane, libellés de formulaire, titres du pied. Partout, elle ne dit
  plus « donnée », elle dit « machine ». Elle garde le SIREN, les prix, les
  horaires, les codes postaux — ce qui se recopie.
- **Le papier s'est réchauffé** (`#FAF8F3` au lieu de `#FCFCFA`) et l'encre
  avec lui. Un site qui envoie quelqu'un chez vous ne peut pas avoir la
  température d'un tableur.
- **Les angles sont passés de 2 à 5 pixels.** Un angle vif partout ne dit pas
  « rigueur », il dit « je n'ai pas fini ».
- **Le pied de page ne se répète plus.** Il affichait deux fois la forme
  juridique, le capital et le RCS — une fois en chasse fixe, une fois en
  texte courant.
- **Le panneau du menu** n'est plus une liste nue : il porte le bouton de
  téléchargement et le numéro d'urgence, que le bandeau lui prend sur un
  écran étroit.

### Le logo

Le logo n'existait qu'en image matricielle — l'icône de l'application, un PNG
sur fond blanc, inutilisable sur un fond coloré et flou dès qu'on l'agrandit.
Il a été **redessiné en vectoriel**
(`resources/views/components/logo.blade.php`).

Le sceau de vérification n'est pas posé *sur* la lettre : il la troue, par un
masque SVG, exactement comme dans l'original. Sa position a été relevée en
rendant le glyphe sur un canevas et en isolant la région fermée du « a » —
pas estimée à l'œil.

### Les visuels

Ce sont les captures de la fiche App Store, recadrées et **détourées** : leur
fond a été rendu transparent par un remplissage depuis les bords, qui
contourne la lunette de l'appareil au lieu de la manger.

---

## Choix techniques

- **Laravel 12**, PHP 8.2, SQLite — la version de XAMPP.
- **Pas de Tailwind.** La charte tient en 700 lignes de CSS écrites à la main
  et lues d'un bout à l'autre. Sur un site d'une vingtaine de pages qui
  partagent dix composants, un cadre utilitaire ajoute une dépendance et une
  étape de compilation pour remplacer ce fichier.
- **Polices auto-hébergées** dans `public/fonts` : Archivo (titres), Inter
  (texte), IBM Plex Mono (données), et Outfit réduit aux onze lettres du logo.
  Aucun appel à `fonts.googleapis.com` — donc aucun visiteur tracé avant
  d'avoir vu la page, et aucun sous-traitant de plus à déclarer dans la
  politique de confidentialité.
- **11 Ko de JavaScript** non minifié (3,6 Ko compressés), sans aucune
  dépendance : menu, simulateur, filtre, onglets, jauge et compteurs. La FAQ
  reste un `<details>`, et les états de survol des transitions CSS.
- **Deux feuilles de style** : `app.css` pose la matière, `mouvement.css`
  pose ce qui bouge. La règle se relit d'un bloc au lieu d'être diluée dans
  sept cents lignes de mise en page.
- **Aucun traceur, aucune mesure d'audience tierce.** Un seul cookie de
  session, déposé à l'envoi du formulaire.
- **Anti-robots sans captcha** : un champ invisible et non tabulable. Un
  script le remplit, un humain non. Pas d'image illisible pour qui voit mal,
  pas de service tiers.

### Le téléphone

Une troisième feuille, `resources/css/telephone.css`, reprend tout ce qui,
sur un écran étroit, ne peut pas se contenter d'être « la même chose en plus
petit ».

Elle existe parce qu'un premier contrôle avait conclu trop vite. Il
vérifiait qu'aucune page ne débordait horizontalement — 168 combinaisons,
aucun débordement — et le site n'en était pas moins mauvais sur téléphone.
**« Ne déborde pas » ne veut pas dire « se tient ».** Une page peut être
parfaitement contenue dans 390 pixels et demander malgré tout douze cents
pixels de défilement avant d'afficher son titre.

Ce qui a changé :

- **Le cartouche se replie en une ligne.** Ses quatre cases prenaient 370 px
  avant tout contenu : on faisait défiler un extrait de registre avant de
  savoir ce que le site propose. Il en prend 47. Un cartouche s'annonce, il
  ne se lit pas.
- **Le titre passe devant le téléphone.** La version précédente ouvrait sur
  une capture d'écran de 800 px qu'il fallait dépasser pour lire la première
  phrase. Une image n'explique rien à qui ne sait pas encore de quoi on parle.
- **Le tampon mord l'angle du téléphone** au lieu d'être posé au milieu de
  son écran : la cellule se rétrécit désormais sur son contenu, donc le
  tampon s'ancre à l'appareil et non au bord d'une colonne bien plus large.
- **Le relevé de preuves passe de 720 px à 377 px** : la clé et son intitulé
  sur une ligne, le détail dessous.
- **Le relevé chiffré ne sépare plus** un nombre de ce qu'il compte.

Contrôle : **12 pages × 14 largeurs**, de 320 à 1920 px, en vérifiant pour
chacune qu'aucun élément ne déborde **et** que le titre principal reste
visible dans les 640 premiers pixels sur mobile. 168 combinaisons, rien à
signaler.

Points de bascule : 1400 px (témoin de section), 1060 px (grilles à deux
colonnes), 900 px (menu en panneau, duos en colonne, simulateur empilé),
680 px (colonne unique), 380 px (typographie resserrée).

### Accessibilité

Lien d'évitement, `aria-current` sur la page en cours, `aria-expanded` sur le
menu, messages de formulaire annoncés (`role="status"` / `role="alert"`),
contrastes tenus à 4,5:1, focus visible partout, et aucune information portée
par la seule couleur.

---

## ⚠ À compléter avant toute mise en ligne

Ces points **ne peuvent pas être inventés** — ils appartiennent à Crafterlity
et engagent la société. Ils sont signalés en clair dans les pages concernées.

1. **L'hébergeur** — nom, dénomination sociale, adresse et téléphone.
   Obligation de l'article 6-III de la LCEN. → `mentions-legales`
2. **Le médiateur de la consommation** — nom et coordonnées. Obligation des
   articles L.612-1 et suivants du code de la consommation. → `mentions-legales`
3. **Le taux de commission** appliqué aux artisans, son assiette, les
   éventuels frais de service côté client, et le délai de versement.
   → `conditions-generales`, `artisans`
4. **Le barème des frais d'annulation** selon le stade de la mission.
   → `conditions-generales`
5. **Les conditions générales dans leur ensemble** doivent être relues et
   arrêtées par un conseil juridique. Le texte couvre les points qu'une
   plateforme de mise en relation avec encaissement doit traiter — rôle de la
   plateforme, formation du contrat, paiement, rétractation, responsabilité,
   article 242 bis du CGI — mais ce n'est pas un texte validé.

### Un point à trancher

La politique de confidentialité en ligne désigne **« TinArt »** comme éditeur
du service, et le bundle de l'application est `com.tinart.crafterlity`. La
société immatriculée est **CRAFTERLITY**. Deux noms différents sur deux
documents qui engagent : soit TinArt est un nom commercial et il doit être
déclaré, soit c'est un reliquat et il faut le corriger partout. Ce site retient
la raison sociale, pour que les mentions légales et la politique de
confidentialité disent la même chose.

### Deux coquilles relevées dans l'application

- écran d'accueil : « Je suis un professionel » → *professionnel*
- fiche App Store : « en temp réel » → *en temps réel*

---

## Ce qui reste à faire

- Renouveler **crafterlity.com**, qui expire le 27 octobre 2026.
- Fournir des photographies de chantier si l'on veut une version illustrée
  des pages métier.
- Brancher une notification par courriel sur le formulaire de contact — les
  messages sont aujourd'hui enregistrés en base, ce qui garantit qu'aucun ne
  se perd, mais personne n'est prévenu.
- Ouvrir une fiche Google Business Profile : une plateforme locale sans fiche
  est invisible sur les recherches « artisan + ville ».
