@props([
    'haut'   => 'Artisan vérifié',
    'bas'    => 'SIRET · INSEE',
    'centre' => null,
    'rouge'  => false,
    'taille' => 140,
])

@php
    /*
        Le tampon.

        C'est la piece d'identite visuelle du site. Une plateforme qui
        repete « artisans verifies » a chaque section finit par ne plus
        etre crue ; un tampon encre, pose une seule fois, dit la meme chose
        et se retient.

        POURQUOI UN TAMPON ET PAS UN BADGE. Les pastilles « certifie »,
        « securise », « garanti » que l'on voit partout sont precisement ce
        qui fait douter : elles sont dessinees par celui qui se les
        decerne. Un tampon appartient au vocabulaire de l'administration —
        il n'annonce pas une qualite, il atteste d'une verification. C'est
        exactement la difference que Crafterlity doit faire comprendre : ce
        n'est pas un label maison, c'est un controle aupres de l'INSEE.

        Il est legerement de travers, parce qu'un tampon pose a la main
        l'est toujours. Deux degres : au-dela, ca devient un effet.

        LA GEOMETRIE DU TEXTE CIRCULAIRE, qui n'est pas evidente.

        Dans un <textPath>, les lettres se dressent perpendiculairement au
        chemin, du cote de sa normale — et la normale change de cote selon
        le SENS de parcours. Consequence : si l'on emploie le meme rayon en
        haut et en bas, le texte du haut deborde VERS L'EXTERIEUR et celui
        du bas rentre VERS L'INTERIEUR. L'anneau n'est plus un anneau.

        D'ou deux rayons differents :

          — l'arc du HAUT est parcouru de gauche a droite par le sommet
            (sweep 1). Ses lettres poussent vers l'exterieur : on pose donc
            sa ligne de base au BORD INTERNE de l'anneau ;
          — l'arc du BAS est parcouru de gauche a droite par le dessous
            (sweep 0) — et non de droite a gauche, sinon le texte se lit a
            l'envers. Ses lettres poussent vers l'interieur : on pose sa
            ligne de base au BORD EXTERNE.

        Les deux textes occupent alors la meme bande, entre 34 et 41.
    */
    $id = 'tampon-'.\Illuminate\Support\Str::random(7);

    $rh = 34;   // ligne de base du haut : bord interne de la bande
    $rb = 41;   // ligne de base du bas  : bord externe de la bande
@endphp

<svg {{ $attributes->merge(['class' => 'tampon'.($rouge ? ' tampon--rouge' : '')]) }}
     viewBox="0 0 100 100" width="{{ $taille }}" height="{{ $taille }}"
     role="img" aria-label="{{ $haut }}. {{ $bas }}." focusable="false">

    <defs>
        <path id="{{ $id }}-h" fill="none"
              d="M {{ 50 - $rh }} 50 A {{ $rh }} {{ $rh }} 0 0 1 {{ 50 + $rh }} 50"/>
        <path id="{{ $id }}-b" fill="none"
              d="M {{ 50 - $rb }} 50 A {{ $rb }} {{ $rb }} 0 0 0 {{ 50 + $rb }} 50"/>
    </defs>

    <g transform="rotate(-2 50 50)">
        <circle cx="50" cy="50" r="47" fill="none" stroke="currentColor" stroke-width="2.4"/>
        <circle cx="50" cy="50" r="43" fill="none" stroke="currentColor" stroke-width="0.7"/>
        <circle cx="50" cy="50" r="31" fill="none" stroke="currentColor" stroke-width="0.7"/>

        <text class="tampon-txt">
            <textPath href="#{{ $id }}-h" startOffset="50%" text-anchor="middle">{{ $haut }}</textPath>
        </text>
        <text class="tampon-txt">
            <textPath href="#{{ $id }}-b" startOffset="50%" text-anchor="middle">{{ $bas }}</textPath>
        </text>

        @if($centre)
            <text class="tampon-centre" x="50" y="50" text-anchor="middle"
                  dominant-baseline="central">{{ $centre }}</text>
        @else
            {{-- La coche du logo, reprise ici : les deux marques se
                 repondent sans qu'on ait a le dire. --}}
            <path d="M38 50.5 46.5 59 63 41.5" fill="none" stroke="currentColor"
                  stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
        @endif

        {{-- Deux traits courts sur les flancs : c'est ce qui fait qu'un
             tampon ressemble a un tampon et pas a un bouton rond. --}}
        <path d="M4 50 h7 M89 50 h7" stroke="currentColor" stroke-width="2.4"
              stroke-linecap="round"/>
    </g>
</svg>
