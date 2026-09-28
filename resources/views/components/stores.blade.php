@props(['clair' => false])

@php $stores = config('crafterlity.stores'); @endphp

{{--
    Les deux liens de telechargement.

    Ils manquent totalement au site actuel : l'application est publiee sur
    les deux boutiques depuis juin 2026, et aucune page de crafterlity.com
    n'y renvoie. Le site ne conduit donc nulle part — c'est le premier
    defaut a corriger, avant meme la mise en forme.

    rel="noopener" sur des liens externes : sans lui, la page ouverte garde
    une reference vers celle-ci via window.opener.
--}}

<div class="stores">
    <a class="store" href="{{ $stores['ios'] }}" rel="noopener">
        <x-icone nom="pomme" :taille="26" />
        <span>
            <span class="k">Télécharger sur</span>
            <span class="v">l'App Store</span>
        </span>
    </a>

    <a class="store" href="{{ $stores['android'] }}" rel="noopener">
        <x-icone nom="android" :taille="26" />
        <span>
            <span class="k">Disponible sur</span>
            <span class="v">Google Play</span>
        </span>
    </a>
</div>
