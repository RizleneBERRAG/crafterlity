@php
    $societe = config('crafterlity.societe');
@endphp
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>@yield('titre', 'Crafterlity') — Trouvez un artisan près de chez vous</title>
    <meta name="description" content="@yield('description', "Crafterlity met en relation les particuliers et des artisans vérifiés : plomberie, électricité, serrurerie, peinture et petits travaux. Prix annoncé avant intervention, paiement sécurisé, suivi en temps réel.")">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="theme-color" content="#FCFCFA">

    {{-- L'icone de l'application sert de favicon : la marque est la meme,
         le visiteur reconnait l'onglet comme il reconnait l'icone sur son
         telephone. --}}
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-180.png') }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Crafterlity">
    <meta property="og:locale" content="fr_FR">
    <meta property="og:title" content="@yield('titre', 'Crafterlity')">
    <meta property="og:description" content="@yield('description', "Trouvez un artisan vérifié près de chez vous. Plomberie, électricité, serrurerie : intervention d'urgence possible en moins d'une heure.")">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/favicon-512.png') }}">
    <meta name="twitter:card" content="summary">

    {{--
        Polices auto-hebergees dans public/fonts. Aucun appel a
        fonts.googleapis.com ni fonts.gstatic.com : la typographie tient
        sans reseau tiers, et aucun visiteur n'est trace avant d'avoir vu
        la page — ce qui evite aussi d'avoir a declarer un sous-traitant
        supplementaire dans la politique de confidentialite.

        crossorigin est obligatoire meme en same-origin : une police est
        toujours recuperee en mode CORS.
    --}}
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/archivo-latin.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/inter-latin.woff2') }}">
    <link rel="preload" as="font" type="font/woff2" crossorigin
          href="{{ asset('fonts/plexmono-400-latin.woff2') }}">
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{--
        La carte d'identite de l'entreprise, en donnees structurees. C'est
        ce que lisent Google, Bing et les assistants conversationnels pour
        savoir QUI edite ce site — et c'est ce qui permet a une fiche
        d'entreprise de se constituer sans qu'on la saisisse a la main.

        Le numero de SIREN est expose en identifiant : il rattache le site
        a une entreprise reelle et verifiable, ce qu'aucune declaration
        marketing ne peut faire.
    --}}
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => 'Crafterlity',
        'legalName'=> $societe['raison'],
        'url'      => route('accueil'),
        'logo'     => asset('images/favicon-512.png'),
        'email'    => $societe['email'],
        'telephone'=> '+33767914587',
        'identifier' => ['@type' => 'PropertyValue', 'name' => 'SIREN', 'value' => $societe['siren']],
        'vatID'    => $societe['tva'],
        'address'  => [
            '@type'           => 'PostalAddress',
            'streetAddress'   => $societe['adresse'],
            'postalCode'      => $societe['code_postal'],
            'addressLocality' => $societe['ville'],
            'addressCountry'  => 'FR',
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>

    @stack('schema')
</head>
<body>
    {{-- Premier element tabulable de la page. Sans lui, un visiteur au
         clavier traverse les sept liens du bandeau a chaque page. --}}
    <a class="evitement" href="#contenu">Aller au contenu</a>

    @include('partials.nav')

    <main id="contenu">
        @yield('contenu')
    </main>

    @include('partials.pied')
</body>
</html>
