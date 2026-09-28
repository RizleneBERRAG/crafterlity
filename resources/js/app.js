/*
 * Le peu de script dont ce site a besoin : l'ouverture du menu, et rien
 * d'autre.
 *
 * Tout le reste tient en CSS. La FAQ est un <details>, les etats de survol
 * sont des transitions, et la charte « Bon d'intervention » n'a aucune
 * animation d'apparition a declencher — les sections sont la, ou elles ne
 * sont pas.
 *
 * Aucune dependance, aucun traceur : moins d'un kilo-octet.
 */

/* ── le menu ───────────────────────────────────────────────────────────
   L'etat vit sur aria-expanded, pas dans une variable JavaScript : c'est
   l'attribut que lit une synthese vocale, et c'est lui qui pilote le
   libelle du bouton (« Menu » / « Fermer ») via le CSS. Une seule source
   de verite, donc aucun risque que l'affichage et l'annonce divergent. */
const burger = document.getElementById('burger');
const menu   = document.getElementById('menu');

if (burger && menu) {
    const basculer = (ouvrir) => {
        burger.setAttribute('aria-expanded', String(ouvrir));
        menu.classList.toggle('ouvert', ouvrir);
        /* Le defilement du corps est bloque tant que le panneau couvre la
           page : sans ca, on fait defiler la page DERRIERE le menu, ce qui
           donne l'impression que le site a plante. */
        document.body.style.overflow = ouvrir ? 'hidden' : '';
    };

    burger.addEventListener('click', () => {
        basculer(burger.getAttribute('aria-expanded') !== 'true');
    });

    /* Echap ferme, et rend le focus au bouton : sans ce retour, le focus
       resterait dans un panneau devenu invisible. */
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && burger.getAttribute('aria-expanded') === 'true') {
            basculer(false);
            burger.focus();
        }
    });

    /* Suivre un lien du panneau doit le refermer. Sur une ancre de la meme
       page, aucune navigation n'a lieu : sans ce gestionnaire, le menu
       resterait ouvert par-dessus la section qu'on vient de demander. */
    menu.querySelectorAll('a').forEach((a) => {
        a.addEventListener('click', () => basculer(false));
    });

    /* Le panneau n'existe que sous 920px. En elargissant la fenetre alors
       qu'il est ouvert, on se retrouverait avec un corps bloque en
       defilement et un menu horizontal : on remet tout a plat. */
    window.matchMedia('(min-width: 921px)').addEventListener('change', (e) => {
        if (e.matches) basculer(false);
    });
}
