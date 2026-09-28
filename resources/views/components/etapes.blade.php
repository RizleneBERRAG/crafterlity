@props(['etapes'])

{{--
    Le parcours, en quatre temps.

    Le rang de chaque etape vient d'un compteur CSS, pas du gabarit : rien
    a numeroter a la main, et l'ordre reste juste le jour ou une etape
    s'ajoute ou disparait.
--}}

<ol class="etapes" style="list-style:none;padding:0;margin:0">
    @foreach($etapes as $etape)
        <li class="etape">
            <span class="rang" aria-hidden="true"></span>
            <div>
                <h3>{{ $etape['titre'] }}</h3>
                <p>{{ $etape['texte'] }}</p>
                <span class="detail">{{ $etape['detail'] }}</span>
            </div>
        </li>
    @endforeach
</ol>
