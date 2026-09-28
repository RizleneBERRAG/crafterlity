/*
 * Le simulateur de demande.
 *
 * Il rejoue le parcours de l'application dans la page : on choisit un
 * metier, on publie une demande, les offres arrivent une a une, on en
 * accepte une, et on suit le trajet du professionnel jusqu'a la fin de la
 * mission.
 *
 * TROIS REGLES QUI TIENNENT TOUT LE FICHIER
 *
 * 1. Le mouvement est MECANIQUE. Le texte se tape, les lignes s'impriment,
 *    la barre se remplit, le compte a rebours descend. Rien ne rebondit,
 *    rien ne s'estompe. Un bon d'intervention se remplit, il ne flotte pas.
 *
 * 2. Les delais sont COMPRIMES. Une vraie offre met des minutes a arriver ;
 *    ici elle met huit cents millisecondes. Le visiteur doit sentir le
 *    rythme du produit, pas l'attendre.
 *
 * 3. « Mouvement reduit » COUPE TOUT. Pas de frappe, pas d'arrivee
 *    echelonnee, pas de barre animee : tout s'affiche d'un coup, et le
 *    parcours reste entierement utilisable. L'animation n'est jamais le
 *    seul moyen d'acceder a une information.
 */

const bloc = document.querySelector('[data-simu]');

if (bloc) {
    const donnees = JSON.parse(bloc.querySelector('[data-simu-donnees]').textContent);

    const bouge = window.matchMedia('(prefers-reduced-motion: no-preference)').matches;
    const attendre = (ms) => new Promise((r) => setTimeout(r, bouge ? ms : 0));

    const etape = (n) => bloc.querySelector(`[data-etape="${n}"]`);
    const sortie = bloc.querySelector('[data-sortie]');
    const champ = bloc.querySelector('[data-texte]');
    const urgence = bloc.querySelector('[data-urgence]');
    const reprendre = bloc.querySelector('[data-reprendre]');

    let metierChoisi = null;
    let villeChoisie = 'Lyon 3e';
    let frappeEnCours = 0;       // jeton d'annulation de la frappe en cours

    /* ── la frappe ─────────────────────────────────────────────────────
       Le texte s'ecrit caractere par caractere. Le jeton evite qu'une
       frappe lancee par un clic precedent continue d'ecrire par-dessus la
       nouvelle : chaque appel invalide le precedent. */
    async function taper(texte) {
        const jeton = ++frappeEnCours;
        champ.textContent = '';
        champ.classList.add('frappe');

        if (!bouge) {
            champ.textContent = texte;
            champ.classList.remove('frappe');
            return;
        }

        for (let i = 0; i < texte.length; i++) {
            if (jeton !== frappeEnCours) return;      // une autre frappe a pris la main
            champ.textContent += texte[i];
            /* Une pause plus longue sur la ponctuation : c'est ce qui
               distingue une frappe humaine d'un defilement de machine. */
            await attendre(',.;:'.includes(texte[i]) ? 90 : 14);
        }

        if (jeton === frappeEnCours) champ.classList.remove('frappe');
    }

    /* ── le choix du metier ──────────────────────────────────────────── */
    bloc.querySelectorAll('[data-metier]').forEach((jeton) => {
        jeton.addEventListener('click', async (e) => {
            /* Les jetons sont des liens vers les pages metier : sans script,
               le bloc reste un sommaire utilisable. Avec script, on reprend
               la main. */
            e.preventDefault();

            metierChoisi = jeton.dataset.metier;

            bloc.querySelectorAll('[data-metier]').forEach((j) => j.classList.remove('actif'));
            jeton.classList.add('actif');

            etape(2).hidden = false;
            etape(3).hidden = false;
            reprendre.hidden = false;

            /* Le metier accepte-t-il l'urgence ? Si non, la case est
               decochee et desactivee : on ne propose pas au visiteur une
               intervention de peinture a minuit. */
            const accepteUrgence = donnees.metiers[metierChoisi].urgence;
            urgence.disabled = !accepteUrgence;
            if (!accepteUrgence) urgence.checked = false;
            urgence.closest('.simu-bascule').classList.toggle('inactif', !accepteUrgence);

            reinitialiserSortie();
            await taper(donnees.exemples[metierChoisi]);
        });
    });

    /* ── le choix de la ville ────────────────────────────────────────── */
    bloc.querySelectorAll('[data-ville]').forEach((jeton, i) => {
        if (i === 0) jeton.classList.add('actif');
        jeton.addEventListener('click', () => {
            bloc.querySelectorAll('[data-ville]').forEach((j) => j.classList.remove('actif'));
            jeton.classList.add('actif');
            villeChoisie = jeton.textContent.trim();
        });
    });

    /* ── la publication ──────────────────────────────────────────────── */
    bloc.querySelector('[data-publier]').addEventListener('click', async () => {
        if (!metierChoisi) return;
        await chercher();
    });

    reprendre.addEventListener('click', () => {
        frappeEnCours++;                 // coupe une frappe en cours
        metierChoisi = null;
        champ.textContent = '';
        urgence.checked = false;
        bloc.querySelectorAll('[data-metier]').forEach((j) => j.classList.remove('actif'));
        etape(2).hidden = true;
        etape(3).hidden = true;
        reprendre.hidden = true;
        reinitialiserSortie();
    });

    function reinitialiserSortie() {
        sortie.innerHTML = `
            <div class="simu-vide">
                <p class="simu-legende"><span class="n">04</span> Les propositions</p>
                <p class="note">Publiez la demande : les offres des professionnels
                apparaîtront ici, une à une.</p>
            </div>`;
    }

    /* ── la recherche, puis les offres ───────────────────────────────── */
    async function chercher() {
        const estUrgent = urgence.checked;

        sortie.innerHTML = `
            <p class="simu-legende"><span class="n">04</span> Les propositions</p>
            <div class="simu-recherche">
                <div class="simu-barre" data-barre><span></span></div>
                <p class="simu-etat mono" data-etat>Envoi de la demande…</p>
            </div>
            <div class="simu-offres" data-offres></div>`;

        const etat = sortie.querySelector('[data-etat]');
        const liste = sortie.querySelector('[data-offres]');

        const messages = estUrgent
            ? ['Envoi de la demande…', 'Recherche dans un rayon de 5 km…', 'Trois professionnels disponibles']
            : ['Envoi de la demande…', 'Recherche des professionnels du secteur…', 'Trois propositions reçues'];

        for (const m of messages) {
            etat.textContent = m;
            await attendre(650);
        }

        sortie.querySelector('[data-barre]').classList.add('fini');

        /* Les offres s'impriment une a une. Le decalage n'est pas
           decoratif : c'est ce qui fait comprendre qu'elles arrivent de
           professionnels differents, et non d'une liste pre-calculee. */
        const offres = donnees.offres[metierChoisi];

        for (let i = 0; i < offres.length; i++) {
            liste.insertAdjacentHTML('beforeend', ligneOffre(offres[i], i, estUrgent));
            await attendre(520);
        }

        liste.querySelectorAll('[data-accepter]').forEach((b) => {
            b.addEventListener('click', () => suivre(offres[+b.dataset.accepter], estUrgent));
        });
    }

    function ligneOffre(o, i, estUrgent) {
        const quand = estUrgent && o.delai !== null
            ? `arrivée ~${o.delai} min`
            : o.jour;

        return `
            <article class="simu-offre">
                <span class="simu-rang mono">${String(i + 1).padStart(2, '0')}</span>
                <div class="simu-qui">
                    <p class="simu-nom">${o.nom} <span class="simu-ent">— ${o.entreprise}</span></p>
                    <p class="simu-meta mono">
                        <span class="simu-verif">SIRET vérifié</span>
                        <span>★ ${o.note}</span>
                        <span>${o.missions} missions</span>
                        <span>${o.km} km</span>
                    </p>
                </div>
                <div class="simu-prix">
                    <span class="simu-montant mono">${o.prix} €</span>
                    <span class="simu-quand mono">${quand}</span>
                </div>
                <button type="button" class="btn petit simu-accepter" data-accepter="${i}">
                    Accepter
                </button>
            </article>`;
    }

    /* ── le suivi d'intervention ─────────────────────────────────────── */
    async function suivre(o, estUrgent) {
        const minutes = estUrgent && o.delai !== null ? o.delai : 20;

        sortie.innerHTML = `
            <p class="simu-legende"><span class="n">05</span> Intervention acceptée</p>

            <div class="simu-suivi">
                <p class="simu-nom" data-titre>${o.nom} est en route vers votre adresse</p>
                <p class="simu-meta mono">${o.entreprise} · ${villeChoisie} · ${o.prix} €</p>

                <div class="simu-trajet">
                    <div class="simu-rail"><span data-rail></span></div>
                    <p class="simu-eta mono" data-eta>Arrivée estimée dans ${minutes} min</p>
                </div>

                <ol class="simu-jalons" data-jalons>
                    <li data-jalon="0">Offre acceptée</li>
                    <li data-jalon="1">En route</li>
                    <li data-jalon="2">Arrivé sur place</li>
                    <li data-jalon="3">Mission terminée</li>
                </ol>

                <p class="simu-paiement mono" data-paiement hidden>
                    ✓ Paiement de ${o.prix} € réglé dans l'application —
                    versement déclenché vers ${o.entreprise}
                </p>
            </div>`;

        const rail = sortie.querySelector('[data-rail]');
        const eta = sortie.querySelector('[data-eta]');
        const titre = sortie.querySelector('[data-titre]');
        const jalons = sortie.querySelectorAll('[data-jalon]');

        const cocher = (n) => jalons[n] && jalons[n].classList.add('fait');
        cocher(0);

        if (!bouge) {
            rail.style.width = '100%';
            [1, 2, 3].forEach(cocher);
            eta.textContent = `Intervention réalisée en ${minutes} min`;
            titre.textContent = 'Intervention terminée';
            sortie.querySelector('[data-paiement]').hidden = false;
            return;
        }

        await attendre(400);
        cocher(1);

        /* Le trajet.
         *
         * La barre est remplie par une TRANSITION CSS, pas par une boucle
         * d'images : on pose la largeur finale, le navigateur s'occupe du
         * reste. Le compte a rebours, lui, tourne sur un intervalle.
         *
         * Ce n'est pas un detail de style. La premiere version pilotait les
         * deux avec requestAnimationFrame, qui est MIS EN PAUSE des que
         * l'onglet passe a l'arriere-plan : il suffisait de changer
         * d'onglet trois secondes pour que le suivi se fige a douze minutes
         * et n'arrive jamais. Une transition CSS et un setInterval
         * continuent de courir, et le visiteur qui revient trouve une
         * mission terminee plutot qu'une barre bloquee. */
        const duree = 8000;
        const debut = Date.now();

        rail.style.transition = `width ${duree}ms linear`;
        rail.style.width = '100%';

        await new Promise((fini) => {
            const horloge = setInterval(() => {
                const t = Math.min((Date.now() - debut) / duree, 1);
                const restant = Math.ceil(minutes * (1 - t));

                eta.textContent = restant > 0
                    ? `Arrivée estimée dans ${restant} min`
                    : 'Le professionnel est arrivé';

                if (t >= 1) { clearInterval(horloge); fini(); }
            }, 250);
        });

        cocher(2);
        titre.textContent = `${o.nom} est arrivé sur place`;
        await attendre(900);

        cocher(3);
        titre.textContent = 'Intervention terminée';
        eta.textContent = `Intervention réalisée en ${minutes} min`;
        sortie.querySelector('[data-paiement]').hidden = false;
    }
}
