@props(['questions', 'etiquettes' => true])

{{--
    La FAQ, construite sur <details>.

    Elle s'ouvre, se ferme et se parcourt au clavier sans une ligne de
    script. Surtout, le contenu reste dans le document meme replie : il est
    donc lu par un moteur de recherche et par une synthese vocale, ce qui
    n'est pas le cas d'un accordeon dont les reponses sont injectees au
    clic.
--}}

<div class="faq">
    @foreach($questions as $item)
        <details class="qr">
            <summary>
                @if($etiquettes)
                    <span class="public {{ $item['public'] === 'pro' ? 'pro' : '' }}">
                        {{ $item['public'] === 'pro' ? 'Artisan' : 'Client' }}
                    </span>
                @endif
                {{ $item['q'] }}
                <span class="signe" aria-hidden="true"></span>
            </summary>
            <p class="reponse">{{ $item['r'] }}</p>
        </details>
    @endforeach
</div>
