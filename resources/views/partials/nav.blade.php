<header class="nav">
    <div class="wrap navin">

        <a class="marque" href="{{ route('accueil') }}" aria-label="Crafterlity, retour à l'accueil">
            <x-logo />
        </a>

        {{-- La reference de la section en cours de lecture, tenue a jour par
             le script. C'est le motif identitaire du site — « REF. 03 —
             L'URGENCE » — employe comme reperage. Purement indicatif : il
             est vide tant que rien n'a ete franchi, et absent sans script. --}}
        <span id="nav-ref" aria-hidden="true"></span>

        {{--
            Le menu est le meme element sur toutes les largeurs : horizontal
            au-dela de 920px, panneau deroulant en deca. Il n'est jamais
            duplique. Un second menu « version mobile » serait deux listes a
            tenir a jour, et la garantie qu'un jour l'une des deux oublie un
            lien.

            aria-current marque la page en cours : c'est l'attribut que lit
            une synthese vocale, et c'est lui qui declenche la pastille
            doree en CSS. Un seul mecanisme pour les deux.
        --}}
        <nav class="menu" id="menu" aria-label="Navigation principale">
            <a href="{{ route('metiers.index') }}"
               @if(request()->routeIs('metiers.*')) aria-current="page" @endif>Services</a>
            <a href="{{ route('methode') }}"
               @if(request()->routeIs('methode')) aria-current="page" @endif>Comment ça marche</a>
            <a href="{{ route('urgence') }}"
               @if(request()->routeIs('urgence')) aria-current="page" @endif>Urgence</a>
            <a href="{{ route('artisans') }}"
               @if(request()->routeIs('artisans')) aria-current="page" @endif>Vous êtes artisan</a>
            <a href="{{ route('questions') }}"
               @if(request()->routeIs('questions')) aria-current="page" @endif>Questions</a>
            <a href="{{ route('contact') }}"
               @if(request()->routeIs('contact')) aria-current="page" @endif>Contact</a>

            {{-- Sous 920px, le bandeau masque le bouton de telechargement.
                 Sans ce rappel au pied du panneau, la seule action du site
                 disparaitrait de toute la navigation sur telephone — c'est
                 pourtant la que se trouvent la moitie des visiteurs d'une
                 page d'application. --}}
            <a class="btn or" href="{{ route('telecharger') }}" style="margin-top:14px">
                Télécharger l'application
            </a>
        </nav>

        <div class="navcta">
            <a class="btn or petit" href="{{ route('telecharger') }}">Télécharger</a>

            {{-- L'intitule suit aria-expanded, que le script tient a jour :
                 l'attribut pilote a la fois l'annonce vocale et l'affichage
                 du mot, il n'y a donc qu'un seul etat a maintenir. --}}
            <button class="burger" id="burger" type="button"
                    aria-expanded="false" aria-controls="menu">
                <span class="ouvrir">Menu</span>
                <span class="fermer">Fermer</span>
            </button>
        </div>

    </div>

    {{-- La jauge de lecture : un filet d'encre rempli par la position de la
         page. Le meme trait que partout ailleurs, charge de dire ou l'on en
         est. Decoratif, donc masque aux synthese vocales. --}}
    <span id="jauge" aria-hidden="true"></span>
</header>
