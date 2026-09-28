@props(['nom', 'taille' => 22])

{{--
    Toutes les icones du site, dans un seul fichier.

    Elles sont dessinees ici plutot que chargees depuis une bibliotheque
    pour trois raisons : aucune dependance a suivre, aucune requete
    supplementaire, et surtout un dessin homogene — meme grille de 24, meme
    epaisseur de trait, memes extremites arrondies. Une icone prise sur
    une bibliotheque et une autre prise ailleurs ne se ressemblent jamais
    tout a fait, et ca se voit.

    Elles heritent de la couleur du texte (currentColor) : c'est ce qui
    leur permet de passer de la nuit au papier sans qu'on ecrive une seule
    variante.

    aria-hidden par defaut : une icone qui double un texte deja present ne
    doit pas etre annoncee deux fois par une synthese vocale.
--}}

@php
    $traits = [

        /* ── les metiers ──────────────────────────────────────────────
           La cle est le slug du metier : le gabarit passe simplement
           $metier['slug'], sans table de correspondance a maintenir. */

        // une goutte
        'plomberie' => '<path d="M12 3.2c3.6 4 5.6 6.6 5.6 9.3a5.6 5.6 0 0 1-11.2 0c0-2.7 2-5.3 5.6-9.3Z"/>',

        // un eclair
        'electricite' => '<path d="M13.4 2.5 5.2 13.1h5.1l-.7 8.4 8.2-10.6h-5.1l.7-8.4Z"/>',

        // une cle
        'serrurerie' => '<circle cx="8.2" cy="8.2" r="4.2"/><path d="m11.4 11.4 8.4 8.4M16.6 16.6l2.1-2.1M18.7 18.7l1.8-1.8"/>',

        // une flamme
        'chauffage-climatisation' => '<path d="M12 2.8s5.4 4.1 5.4 9.1a5.4 5.4 0 0 1-10.8 0c0-1.6.6-2.9 1.4-4 .2 1.3 1 2.2 1.9 2.2 1.3 0 2.1-1.7 2.1-3.6 0-1.6-.4-2.8 0-3.7Z"/>',

        // un rouleau a peindre
        'peinture' => '<rect x="3.2" y="3.6" width="12.4" height="5.4" rx="1.6"/><path d="M15.6 6.3h3.3a1.9 1.9 0 0 1 1.9 1.9v2.3a1.9 1.9 0 0 1-1.9 1.9h-7.4a1.4 1.4 0 0 0-1.4 1.4v1.3"/><rect x="8.6" y="15.1" width="3.4" height="5.6" rx="1.1"/>',

        // quatre carreaux
        'carrelage' => '<rect x="3.2" y="3.2" width="7.4" height="7.4" rx="1.3"/><rect x="13.4" y="3.2" width="7.4" height="7.4" rx="1.3"/><rect x="3.2" y="13.4" width="7.4" height="7.4" rx="1.3"/><rect x="13.4" y="13.4" width="7.4" height="7.4" rx="1.3"/>',

        // une scie a main
        'menuiserie' => '<path d="M3 5.4h13.1l4.6 4.6-3.1 3.1L3 5.4Z"/><path d="m5.6 8 1.5 1.6M8.8 9.4l1.5 1.6M12 10.8l1.5 1.6"/><path d="M4.4 12.6v6.6a1.6 1.6 0 0 0 1.6 1.6h2.1"/>',

        // un cube en kit
        'montage-de-meubles' => '<path d="M12 2.9 20.6 7v10L12 21.1 3.4 17V7L12 2.9Z"/><path d="M3.4 7 12 11.3 20.6 7M12 11.3v9.8"/>',

        // une cle plate
        'petits-travaux' => '<path d="M15.6 3.4a5.3 5.3 0 0 0-5 8.7L4 18.7a2 2 0 0 0 2.8 2.8l6.6-6.6a5.3 5.3 0 0 0 6.5-7.3l-3 3-2.8-.7-.7-2.8 3-3a5.3 5.3 0 0 0-.8-.7Z"/>',

        // un carreau de vitre fissure
        'vitrerie' => '<rect x="3.4" y="3.4" width="17.2" height="17.2" rx="2"/><path d="m3.4 12 5.2-2.4L12 12l3-3.4 5.6 2.6M8.6 9.6 7 3.4M12 12l1.4 8.6"/>',

        /* ── le vocabulaire commun ───────────────────────────────────── */

        'coche'     => '<path d="m4.6 12.4 4.8 4.8 10-10.4"/>',
        'fleche'    => '<path d="M4.5 12h15M13.4 5.9 19.5 12l-6.1 6.1"/>',
        'bouclier'  => '<path d="M12 2.8 4.4 6v6c0 4.6 3.2 8.2 7.6 9.2 4.4-1 7.6-4.6 7.6-9.2V6L12 2.8Z"/><path d="m8.8 12 2.2 2.2 4.2-4.4"/>',
        'horloge'   => '<circle cx="12" cy="12" r="9.2"/><path d="M12 6.6V12l3.6 2.2"/>',
        'position'  => '<path d="M12 21.4s7-5.6 7-11a7 7 0 1 0-14 0c0 5.4 7 11 7 11Z"/><circle cx="12" cy="10.2" r="2.7"/>',
        'carte'     => '<path d="m3.2 6.2 5.8-2.4 6 2.4 5.8-2.4v14l-5.8 2.4-6-2.4-5.8 2.4v-14Z"/><path d="M9 3.8v14M15 6.2v14"/>',
        'euro'      => '<path d="M17.4 5.6a7.4 7.4 0 0 0-10.6 3M6.8 15.4a7.4 7.4 0 0 0 10.6 3M3.6 10.4h8.8M3.6 13.8h8.8"/>',
        'telephone' => '<path d="M6.2 3.6h3.2l1.6 4-2 1.4a11.4 11.4 0 0 0 5.2 5.2l1.4-2 4 1.6v3.2a1.8 1.8 0 0 1-2 1.8A15.8 15.8 0 0 1 4.4 5.6a1.8 1.8 0 0 1 1.8-2Z"/>',
        'courriel'  => '<rect x="2.8" y="4.8" width="18.4" height="14.4" rx="2.2"/><path d="m3.6 7 8.4 6 8.4-6"/>',
        'etoile'    => '<path d="m12 3.2 2.8 5.7 6.3.9-4.6 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2-4.6-4.4 6.3-.9L12 3.2Z"/>',
        'appareil'  => '<rect x="6.4" y="2.4" width="11.2" height="19.2" rx="2.6"/><path d="M10.6 5.4h2.8M12 18.4h.01"/>',
        'pomme'     => '<path d="M16.1 12.4c0-2.3 1.9-3.4 2-3.5-1.1-1.6-2.8-1.8-3.4-1.8-1.4-.1-2.8.9-3.5.9-.7 0-1.8-.8-3-.8-1.5 0-3 .9-3.8 2.3-1.6 2.8-.4 7 1.2 9.3.8 1.1 1.7 2.4 2.9 2.3 1.2 0 1.6-.7 3-.7s1.8.7 3 .7c1.2 0 2-1.1 2.8-2.2.6-.9 1-1.8 1.2-2.4-2.5-1-2.4-3.9-2.4-4.1Z"/><path d="M13.9 5c.6-.8 1-1.9.9-3-.9 0-2 .6-2.7 1.4-.6.7-1.1 1.8-.9 2.9 1 .1 2-.5 2.7-1.3Z"/>',
        'android'   => '<path d="M4.6 9.8h14.8v7.4a1.4 1.4 0 0 1-1.4 1.4H6a1.4 1.4 0 0 1-1.4-1.4V9.8Z"/><path d="M4.6 9.8a7.4 7.4 0 0 1 14.8 0M8.4 6.2 6.8 3.6M15.6 6.2l1.6-2.6M9.4 13.2h.01M14.6 13.2h.01"/><path d="M2.2 11.6v3.8M21.8 11.6v3.8M8.6 18.6v2.4M15.4 18.6v2.4"/>',
        'document'  => '<path d="M13.4 2.8H7a2 2 0 0 0-2 2v14.4a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8.4l-5.6-5.6Z"/><path d="M13.4 2.8v5.6H19M8.4 13h7.2M8.4 16.6h4.8"/>',
        'sablier'   => '<path d="M7 3h10M7 21h10M8 3v3.6c0 1.6 4 3.6 4 5.4s-4 3.8-4 5.4V21M16 3v3.6c0 1.6-4 3.6-4 5.4s4 3.8 4 5.4V21"/>',
    ];
@endphp

<svg {{ $attributes->merge(['aria-hidden' => 'true']) }}
     width="{{ $taille }}" height="{{ $taille }}" viewBox="0 0 24 24"
     fill="none" stroke="currentColor" stroke-width="1.7"
     stroke-linecap="round" stroke-linejoin="round" focusable="false">
    {!! $traits[$nom] ?? $traits['coche'] !!}
</svg>
