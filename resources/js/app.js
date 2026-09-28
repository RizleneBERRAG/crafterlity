import './simulateur.js';

/*
 * Ce que ce fichier fait bouger.
 *
 * La charte « Bon d'intervention » s'interdisait d'abord toute animation.
 * La page etait juste, et morte. Le mouvement est revenu, mais avec une
 * regle : il doit etre MECANIQUE. Les filets se tracent, les chiffres
 * defilent, la reference de section s'incremente, la jauge se remplit.
 * Rien ne rebondit, rien ne s'estompe, rien n'apparait « en douceur ».
 * Un document se remplit ; il ne flotte pas.
 *
 * Trois garde-fous valent pour tous les modules ci-dessous :
 *
 *   — l'etat de depart est pose par le SCRIPT, jamais par la feuille de
 *     style. Si le JavaScript ne s'execute pas, rien n'est jamais masque ;
 *   — « mouvement reduit » demande : tout s'affiche d'un coup, et rien ne
 *     se perd ;
 *   — aucune information n'existe uniquement dans une animation.
 */

const BOUGE = window.matchMedia('(prefers-reduced-motion: no-preference)').matches;

/* ═══ le menu ════════════════════════════════════════════════════════
   L'etat vit sur aria-expanded, pas dans une variable : c'est l'attribut
   que lit une synthese vocale, et c'est lui qui pilote le libelle du
   bouton via le CSS. Une seule source de verite. */

const burger = document.getElementById('burger');
const menu = document.getElementById('menu');

if (burger && menu) {
    const basculer = (ouvrir) => {
        burger.setAttribute('aria-expanded', String(ouvrir));
        menu.classList.toggle('ouvert', ouvrir);
        /* Sans ce verrou, on fait defiler la page DERRIERE le panneau, ce
           qui donne l'impression que le site a plante. */
        document.body.style.overflow = ouvrir ? 'hidden' : '';
    };

    burger.addEventListener('click', () => {
        basculer(burger.getAttribute('aria-expanded') !== 'true');
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && burger.getAttribute('aria-expanded') === 'true') {
            basculer(false);
            burger.focus();     // sans ce retour, le focus reste dans un panneau invisible
        }
    });

    menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', () => basculer(false)));

    window.matchMedia('(min-width: 901px)').addEventListener('change', (e) => {
        if (e.matches) basculer(false);
    });
}

/* ═══ la jauge de lecture ════════════════════════════════════════════
   Un filet qui se remplit sur le bord bas du bandeau. C'est le motif de
   la maison — un trait — employe a dire ou l'on en est. Purement
   indicatif : rien n'en depend. */

const jauge = document.getElementById('jauge');

if (jauge) {
    const tracer = () => {
        const h = document.documentElement.scrollHeight - window.innerHeight;
        jauge.style.transform = `scaleX(${h > 0 ? Math.min(window.scrollY / h, 1) : 0})`;
    };
    tracer();
    window.addEventListener('scroll', tracer, { passive: true });
    window.addEventListener('resize', tracer);
}

/* ═══ l'apparition des blocs ═════════════════════════════════════════
   Un bloc entre dans le champ de vision : son filet se trace, son contenu
   monte de huit pixels. Douze pixels auraient fait « effet », huit font
   « la page se remplit ».

   L'etat initial est pose ici et non en CSS : sans script, tout est
   visible des le premier octet. */

const aAnimer = document.querySelectorAll('[data-anime]');

if (aAnimer.length && BOUGE && 'IntersectionObserver' in window) {
    aAnimer.forEach((el) => el.classList.add('avant'));

    const oeil = new IntersectionObserver((entrees) => {
        entrees.forEach((e) => {
            if (!e.isIntersecting) return;
            e.target.classList.add('vu');
            oeil.unobserve(e.target);      // une fois monte, l'element est oublie
        });
    }, { rootMargin: '0px 0px -10% 0px', threshold: 0.08 });

    aAnimer.forEach((el) => oeil.observe(el));
}

/* ═══ les compteurs ══════════════════════════════════════════════════
   Les chiffres du bandeau de preuves defilent jusqu'a leur valeur. Ils
   sont deja ecrits dans le HTML : le script ne fait que les remonter a
   zero et les redescendre. Sans lui, la valeur juste est la, tout de
   suite. */

const compteurs = document.querySelectorAll('[data-compteur]');

if (compteurs.length && BOUGE && 'IntersectionObserver' in window) {
    const oeil = new IntersectionObserver((entrees) => {
        entrees.forEach((e) => {
            if (!e.isIntersecting) return;
            defiler(e.target);
            oeil.unobserve(e.target);
        });
    }, { threshold: 0.6 });

    compteurs.forEach((el) => oeil.observe(el));

    function defiler(el) {
        const final = el.textContent;
        const cible = parseFloat(final.replace(/[^\d.,]/g, '').replace(',', '.'));
        if (!isFinite(cible) || cible === 0) return;

        const avant = final.slice(0, final.search(/[\d]/));
        const apres = final.slice(final.search(/[\d]/) + String(cible).replace('.', ',').length);
        const decimales = (final.match(/[.,](\d+)/) || ['', ''])[1].length;

        const duree = 900;
        const debut = performance.now();

        /* La largeur est figee avant le defilement : sans ca, la cellule
           se redimensionne a chaque image et toute la ligne tremble. */
        el.style.minWidth = el.getBoundingClientRect().width + 'px';
        el.style.display = 'inline-block';

        function image(t) {
            const p = Math.min((t - debut) / duree, 1);
            /* Une sortie rapide puis un ralenti : un compteur mecanique
               ne s'arrete pas net. */
            const valeur = cible * (1 - Math.pow(1 - p, 3));
            el.textContent = avant + valeur.toFixed(decimales).replace('.', ',') + apres;
            if (p < 1) requestAnimationFrame(image); else el.textContent = final;
        }
        requestAnimationFrame(image);
    }
}

/* ═══ la reference courante, dans le bandeau ═════════════════════════
   Le bandeau affiche la section ou se trouve le lecteur : « REF. 03 —
   L'URGENCE ». C'est le motif identitaire du site rendu vivant, et
   accessoirement un reperage utile sur les pages longues.

   Le numero n'est pas lu dans le DOM — il vient d'un compteur CSS, donc
   il n'existe nulle part en texte. Il est donc recalcule ici, dans
   l'ordre du document, exactement comme le fait le compteur. */

const temoin = document.getElementById('nav-ref');
const refs = [...document.querySelectorAll('.ref:not(.muette)')];

if (temoin && refs.length && 'IntersectionObserver' in window) {
    const numero = new Map();
    refs.forEach((r, i) => numero.set(r, String(i + 1).padStart(2, '0')));

    let visibles = new Set();

    const oeil = new IntersectionObserver((entrees) => {
        entrees.forEach((e) => (e.isIntersecting ? visibles.add(e.target) : visibles.delete(e.target)));

        /* La derniere reference franchie, pas la premiere visible : c'est
           celle sous laquelle on lit. */
        const franchies = refs.filter((r) => r.getBoundingClientRect().top < 140);
        const courante = franchies[franchies.length - 1];

        if (courante) {
            temoin.textContent = `Réf. ${numero.get(courante)} — ${courante.textContent.trim()}`;
            temoin.classList.add('visible');
        } else {
            temoin.classList.remove('visible');
        }
    }, { rootMargin: '-140px 0px 0px 0px', threshold: [0, 1] });

    refs.forEach((r) => oeil.observe(r));
    window.addEventListener('scroll', () => oeil.takeRecords() && null, { passive: true });

    /* IntersectionObserver ne se declenche pas pendant un defilement qui ne
       traverse aucune cible. Un rappel au defilement tient le temoin a jour
       entre deux franchissements. */
    let enAttente = false;
    window.addEventListener('scroll', () => {
        if (enAttente) return;
        enAttente = true;
        requestAnimationFrame(() => {
            enAttente = false;
            const franchies = refs.filter((r) => r.getBoundingClientRect().top < 140);
            const courante = franchies[franchies.length - 1];
            if (courante) {
                temoin.textContent = `Réf. ${numero.get(courante)} — ${courante.textContent.trim()}`;
                temoin.classList.add('visible');
            } else {
                temoin.classList.remove('visible');
            }
        });
    }, { passive: true });
}

/* ═══ le filtre des metiers ══════════════════════════════════════════
   Sur la page des services, un champ filtre les dix metiers a la frappe,
   en cherchant aussi dans leurs interventions. Taper « fuite » doit
   ramener la plomberie, meme si le mot n'est pas dans son titre.

   Le champ est ajoute PAR LE SCRIPT : sans JavaScript, il n'apparait pas,
   et la liste complete reste consultable. Un filtre mort dans une page est
   pire que pas de filtre. */

const grilleFiltrable = document.querySelector('[data-filtre]');

if (grilleFiltrable) {
    const cellules = [...grilleFiltrable.querySelectorAll('.carte')];

    const barre = document.createElement('div');
    barre.className = 'filtre';
    barre.innerHTML = `
        <label class="filtre-label mono" for="filtre-metier">Filtrer</label>
        <input type="search" id="filtre-metier" class="filtre-champ"
               placeholder="fuite, tableau électrique, porte claquée…"
               autocomplete="off">
        <span class="filtre-compte mono" data-compte></span>`;
    grilleFiltrable.before(barre);

    const champ = barre.querySelector('input');
    const compte = barre.querySelector('[data-compte]');

    /* Les accents sont retires des deux cotes : « electricite » doit
       trouver « Électricité ». Sans ca, le filtre ne sert qu'a ceux qui
       tapent les accents, c'est-a-dire presque personne. */
    const nu = (s) => s.normalize('NFD').replace(/[̀-ͯ]/g, '').toLowerCase();

    const dire = (n) => {
        compte.textContent = n === cellules.length
            ? `${n} services`
            : n === 0 ? 'aucun résultat' : `${n} sur ${cellules.length}`;
    };
    dire(cellules.length);

    champ.addEventListener('input', () => {
        const q = nu(champ.value.trim());
        let n = 0;

        cellules.forEach((c) => {
            const trouve = !q || nu(c.dataset.recherche || c.textContent).includes(q);
            c.hidden = !trouve;
            if (trouve) n++;
        });

        grilleFiltrable.classList.toggle('vide', n === 0);
        dire(n);
    });
}

/* ═══ les onglets de captures ════════════════════════════════════════
   Un seul telephone, quatre ecrans. Le visiteur choisit ce qu'il regarde
   au lieu de faire defiler quatre images.

   Les quatre images sont dans le HTML des le depart : sans script, on les
   voit toutes, les unes sous les autres. Le script les empile et ajoute
   les onglets. */

document.querySelectorAll('[data-onglets]').forEach((bloc) => {
    const vues = [...bloc.querySelectorAll('[data-vue]')];
    if (vues.length < 2) return;

    const onglets = document.createElement('div');
    onglets.className = 'onglets';
    onglets.setAttribute('role', 'tablist');

    vues.forEach((vue, i) => {
        const b = document.createElement('button');
        b.type = 'button';
        b.className = 'onglet';
        b.textContent = vue.dataset.vue;
        b.setAttribute('role', 'tab');
        b.setAttribute('aria-selected', String(i === 0));

        b.addEventListener('click', () => montrer(i));

        /* Les fleches parcourent les onglets : c'est ce qu'attend
           quiconque navigue au clavier dans une liste d'onglets. */
        b.addEventListener('keydown', (e) => {
            const d = e.key === 'ArrowRight' ? 1 : e.key === 'ArrowLeft' ? -1 : 0;
            if (!d) return;
            e.preventDefault();
            const suivant = (i + d + vues.length) % vues.length;
            montrer(suivant);
            onglets.children[suivant].focus();
        });

        onglets.appendChild(b);
    });

    bloc.classList.add('avec-onglets');
    bloc.prepend(onglets);

    function montrer(n) {
        vues.forEach((v, i) => v.classList.toggle('active', i === n));
        [...onglets.children].forEach((b, i) => b.setAttribute('aria-selected', String(i === n)));
    }
    montrer(0);
});
