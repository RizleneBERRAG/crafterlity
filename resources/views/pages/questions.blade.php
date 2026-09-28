@extends('layouts.app')

@section('titre', 'Questions fréquentes')
@section('description', "Prix, vérification des artisans, délais d'urgence, paiement, commission, annulation : les réponses aux questions des particuliers et des professionnels.")

@push('schema')
{{-- La FAQ complete en donnees structurees : c'est ce que Google affiche
     directement sous le lien, et ce dans quoi les assistants
     conversationnels puisent leurs reponses. Pour une plateforme sans
     budget publicitaire, c'est le canal le plus rentable. --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => collect(config('parcours.faq'))->map(fn ($q) => [
        '@type' => 'Question',
        'name'  => $q['q'],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $q['r']],
    ])->values()->all(),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endpush

@section('contenu')

<section class="bande serree">
    <div class="wrap">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Questions</span>
        </nav>

        <x-chapitre rubrique="Questions fréquentes"
                    titre="Les réponses, sans détour"
                    niveau="h1">
            Elles sont classées par public : les questions de particuliers
            d'abord, celles des artisans ensuite.
        </x-chapitre>
    </div>
</section>

<section class="bande jour">
    <div class="wrap">
        <div style="max-width:900px;margin-inline:auto">

            <h2 id="particuliers" style="margin-bottom:24px">Vous cherchez un artisan</h2>
            <x-faq :questions="$groupes['client']" :etiquettes="false" />

            <h2 id="artisans" style="margin:clamp(48px,6vw,80px) 0 24px">Vous êtes artisan</h2>
            <x-faq :questions="$groupes['pro']" :etiquettes="false" />

        </div>
    </div>
</section>

<section class="bande">
    <div class="wrap" style="text-align:center">
        <x-chapitre rubrique="Vous n'avez pas trouvé" titre="Posez-nous la question" centre>
            Une question sans réponse ici est une question mal anticipée de
            notre part : elle nous intéresse.
        </x-chapitre>

        <div class="btns centre">
            <a class="btn or" href="{{ route('contact') }}">Nous écrire</a>
            <a class="btn creux" href="tel:+33767914587">
                {{ config('crafterlity.societe.telephone') }}
            </a>
        </div>
    </div>
</section>

@endsection
