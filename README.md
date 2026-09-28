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

## Mise en route

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm run build
php artisan serve
```

Base SQLite par défaut : aucun serveur de base de données à installer.

```bash
php artisan test     # 12 tests, 182 assertions
npm run dev          # rechargement à chaud pendant le développement
```

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

- **Laravel 13**, PHP 8.2+, SQLite.
- **Pas de Tailwind.** La charte tient en 700 lignes de CSS écrites à la main
  et lues d'un bout à l'autre. Sur un site d'une vingtaine de pages qui
  partagent dix composants, un cadre utilitaire ajoute une dépendance et une
  étape de compilation pour remplacer ce fichier.
- **Polices auto-hébergées** dans `public/fonts` : Archivo (titres), Inter
  (texte), IBM Plex Mono (données), et Outfit réduit aux onze lettres du logo.
  Aucun appel à `fonts.googleapis.com` — donc aucun visiteur tracé avant
  d'avoir vu la page, et aucun sous-traitant de plus à déclarer dans la
  politique de confidentialité.
- **1 Ko de JavaScript**, pour l'ouverture du menu. La FAQ est un `<details>`,
  les états de survol sont des transitions CSS.
- **Aucun traceur, aucune mesure d'audience tierce.** Un seul cookie de
  session, déposé à l'envoi du formulaire.
- **Anti-robots sans captcha** : un champ invisible et non tabulable. Un
  script le remplit, un humain non. Pas d'image illisible pour qui voit mal,
  pas de service tiers.

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
