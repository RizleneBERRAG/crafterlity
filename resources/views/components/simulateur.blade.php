@php
    $metiers = config('metiers');
    $donnees = [
        'exemples' => config('simulation.exemples'),
        'offres'   => config('simulation.offres'),
        'metiers'  => collect($metiers)->mapWithKeys(fn ($m) => [
            $m['slug'] => ['nom' => $m['nom'], 'urgence' => $m['urgence']],
        ])->all(),
    ];
@endphp

{{--
    Le simulateur de demande.

    C'est le seul endroit du site ou le visiteur FAIT quelque chose au lieu
    de lire. Il choisit un metier, publie une demande, voit arriver des
    offres, en accepte une et suit le trajet — le parcours complet de
    l'application, sans l'installer.

    Trois captures d'ecran ne diront jamais ce que dit une offre qui arrive
    sous les yeux. Pour une plateforme de mise en relation, c'est la
    difference entre expliquer et montrer.

    HONNETETE. Les donnees sont inventees, et le composant le dit deux fois :
    en tete, et sous le resultat. Sur un site dont tout l'enjeu est de ne
    pas ressembler a une arnaque, faire passer des artisans fictifs pour
    reels serait exactement l'erreur a ne pas commettre.

    SANS SCRIPT. Le premier ecran affiche les dix metiers sous forme de
    liens vers leurs pages. Si le JavaScript ne s'execute pas, le bloc reste
    un sommaire utile au lieu de devenir une boite vide.
--}}

<div class="simu" data-simu>

    <script type="application/json" data-simu-donnees>
        {!! json_encode($donnees, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    <div class="simu-tete">
        <span class="ref">Simulation</span>
        <p class="note simu-avis">
            Démonstration du parcours. Les professionnels, les prix et les
            délais affichés ci-dessous sont des <strong>données d'exemple</strong>.
        </p>
    </div>

    <div class="simu-corps">

        {{-- ── la colonne du formulaire ─────────────────────────────── --}}
        <div class="simu-form">

            <div class="simu-etape" data-etape="1">
                <p class="simu-legende"><span class="n">01</span> Votre besoin</p>

                <div class="simu-metiers">
                    @foreach($metiers as $metier)
                        <a class="simu-jeton" href="{{ route('metiers.show', $metier['slug']) }}"
                           data-metier="{{ $metier['slug'] }}">{{ $metier['nom'] }}</a>
                    @endforeach
                </div>
            </div>

            <div class="simu-etape" data-etape="2" hidden>
                <p class="simu-legende"><span class="n">02</span> Décrivez-le</p>

                {{-- Le texte s'ecrit caractere par caractere : c'est ce qui
                     donne l'impression que quelqu'un remplit le formulaire,
                     et c'est le seul mouvement « vivant » du bloc. --}}
                <div class="simu-champ" data-texte aria-live="polite"></div>

                <label class="simu-bascule">
                    <input type="checkbox" data-urgence>
                    <span class="simu-case" aria-hidden="true"></span>
                    <span>C'est une urgence — intervention dans l'heure</span>
                </label>
            </div>

            <div class="simu-etape" data-etape="3" hidden>
                <p class="simu-legende"><span class="n">03</span> Adresse d'intervention</p>

                <div class="simu-villes">
                    <button type="button" class="simu-jeton" data-ville>Lyon 3<sup>e</sup></button>
                    <button type="button" class="simu-jeton" data-ville>Villeurbanne</button>
                    <button type="button" class="simu-jeton" data-ville>Vénissieux</button>
                </div>

                <button type="button" class="btn plein simu-publier" data-publier>
                    Publier la demande
                </button>
            </div>

            <button type="button" class="simu-reprendre" data-reprendre hidden>
                ↺ Recommencer la simulation
            </button>
        </div>

        {{-- ── la colonne du resultat ───────────────────────────────── --}}
        <div class="simu-sortie" data-sortie>
            <div class="simu-vide" data-vide>
                <p class="simu-legende"><span class="n">04</span> Les propositions</p>
                <p class="note">
                    Choisissez un métier à gauche : les offres des
                    professionnels apparaîtront ici.
                </p>
            </div>
        </div>

    </div>
</div>
