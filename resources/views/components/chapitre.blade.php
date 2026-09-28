@props(['rubrique' => null, 'titre', 'niveau' => 'h2', 'centre' => false])

{{--
    L'en-tete d'une section : rubrique, titre, chapeau.

    Le niveau de balise est un parametre parce que la hierarchie des titres
    est une structure de document, pas une taille de texte. Une page a un
    seul h1 ; une section imbriquee descend en h3 sans changer d'allure.
    Confondre les deux, c'est casser le sommaire que se construit une
    synthese vocale.
--}}

<div class="chapitre @if($centre) centre @endif" @if(!$centre) @endif>
    @if($rubrique)
        <span class="ref">{{ $rubrique }}</span>
    @endif

    <{{ $niveau }}>{!! $titre !!}</{{ $niveau }}>

    @if(trim($slot))
        <p class="lede">{{ $slot }}</p>
    @endif
</div>
