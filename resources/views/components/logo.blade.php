@props(['titre' => null])

@php
    /*
        Le logo de Crafterlity, redessine en vectoriel.

        L'original n'existe qu'en image matricielle : l'icone de
        l'application, un PNG de 1024 pixels sur fond blanc. Inutilisable
        sur une page sombre, flou des qu'on l'agrandit, et impossible a
        recolorer. Il fallait donc le reconstruire.

        LA LETTRE. La police est Outfit, choisie apres comparaison : comme
        le logo, elle a un « a » d'un seul etage parfaitement circulaire,
        un « f » a terminaison horizontale et un « y » a descendante
        droite. Les trois signes qui donnent son caractere au mot.

        LA GEOMETRIE. Les coordonnees ci-dessous ne sont pas estimees a
        l'oeil : le contre-poincon du « a » a ete localise en rendant le
        glyphe sur un canevas et en isolant la region fermee. A corps 100,
        son centre tombe a 28,7 unites a droite de l'origine du glyphe et
        25 unites au-dessus de la ligne de base ; le « a » lui-meme commence
        a 84,34 avec une approche de -4. D'ou le centre du sceau : (113, 49)
        pour une ligne de base posee a 74.

        L'EVIDEMENT. Dans l'original, le sceau n'est pas pose SUR la lettre :
        il la troue, et c'est le fond de la page qui apparait au travers.
        Un simple disque de couleur aurait oblige a declarer le fond a
        chaque emploi — et se serait vu sur le bandeau, dont le fond est
        semi-transparent et laisse defiler la page derriere lui. Le masque
        SVG reproduit le vrai trou : le mot est peint en blanc dans le
        masque, le sceau en noir l'y perce, la coche en blanc y revient.

        La couleur vient de currentColor : le logo suit la couleur du texte
        de son conteneur, donc l'or sur la nuit et l'encre a l'impression,
        sans une seule variante a maintenir.
    */

    // Le masque porte un identifiant unique : le logo parait deux fois par
    // page (bandeau et pied), et deux id identiques dans un document sont
    // une erreur de balisage — que certains navigateurs resolvent mal.
    $id = 'logo-'.\Illuminate\Support\Str::random(7);

    // Le sceau de verification : douze lobes, rayons alternes 48 et 41 sur
    // une grille de 100, coins adoucis par des quadratiques. Genere une
    // fois, fige ici — le recalculer a chaque affichage ne changerait rien.
    $sceau = 'M55.31 6.20Q60.61 10.40 67.31 9.41Q74.00 8.43 76.50 14.72Q78.99 21.01 85.28 23.50'
           .'Q91.57 26.00 90.59 32.69Q89.60 39.39 93.80 44.69Q98.00 50.00 93.80 55.31'
           .'Q89.60 60.61 90.59 67.31Q91.57 74.00 85.28 76.50Q78.99 78.99 76.50 85.28'
           .'Q74.00 91.57 67.31 90.59Q60.61 89.60 55.31 93.80Q50.00 98.00 44.69 93.80'
           .'Q39.39 89.60 32.69 90.59Q26.00 91.57 23.50 85.28Q21.01 78.99 14.72 76.50'
           .'Q8.43 74.00 9.41 67.31Q10.40 60.61 6.20 55.31Q2.00 50.00 6.20 44.69'
           .'Q10.40 39.39 9.41 32.69Q8.43 26.00 14.72 23.50Q21.01 21.01 23.50 14.72'
           .'Q26.00 8.43 32.69 9.41Q39.39 10.40 44.69 6.20Q50.00 2.00 55.31 6.20Z';

    // 16,5 / 48 : le sceau passe d'un rayon de 48 a un rayon de 16,5, soit
    // un diametre de 33 pour un contre-poincon de 19. Il deborde donc sur
    // les pleins du « a », exactement comme dans l'original.
    $pose = 'translate(113 49) scale(0.34375) translate(-50 -50)';
@endphp

<svg {{ $attributes->merge(['class' => 'logo']) }}
     viewBox="0 0 446 96" fill="currentColor"
     role="img" focusable="false"
     @if($titre) aria-label="{{ $titre }}" @else aria-hidden="true" @endif>

    @if($titre)<title>{{ $titre }}</title>@endif

    <mask id="{{ $id }}" maskUnits="userSpaceOnUse" x="0" y="0" width="446" height="96">
        <rect x="0" y="0" width="446" height="96" fill="black"/>

        <text x="0" y="74" fill="white"
              font-family="Marque, sans-serif"
              font-size="100" font-weight="800" letter-spacing="-4"
              xml:space="preserve">crafterlity</text>

        <g transform="{{ $pose }}">
            {{-- le sceau perce la lettre --}}
            <path d="{{ $sceau }}" fill="black"/>
            {{-- la coche revient dans le trou --}}
            <path d="M31 51.5 44 64.5 70 36" fill="none" stroke="white"
                  stroke-width="12" stroke-linecap="round" stroke-linejoin="round"/>
        </g>
    </mask>

    <rect x="0" y="0" width="446" height="96" mask="url(#{{ $id }})"/>
</svg>
