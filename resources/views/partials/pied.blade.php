@php
    $societe = config('crafterlity.societe');
    $stores  = config('crafterlity.stores');
@endphp

<footer class="pied">
    <div class="wrap">

        <div class="piedin">

            <div>
                <x-logo titre="Crafterlity" />
                <p class="signature">
                    Mise en relation avec des artisans vérifiés, pour vos travaux et
                    vos dépannages à domicile. Application disponible sur iOS
                    et Android.
                </p>
            </div>

            <div>
                <h4>Services</h4>
                <ul>
                    @foreach(collect(config('metiers'))->take(6) as $metier)
                        <li><a href="{{ route('metiers.show', $metier['slug']) }}">{{ $metier['nom'] }}</a></li>
                    @endforeach
                    <li><a href="{{ route('metiers.index') }}">Tous les services</a></li>
                </ul>
            </div>

            <div>
                <h4>Crafterlity</h4>
                <ul>
                    <li><a href="{{ route('methode') }}">Comment ça marche</a></li>
                    <li><a href="{{ route('urgence') }}">Intervention d'urgence</a></li>
                    <li><a href="{{ route('artisans') }}">Devenir artisan partenaire</a></li>
                    <li><a href="{{ route('telecharger') }}">Télécharger l'application</a></li>
                    <li><a href="{{ route('questions') }}">Questions fréquentes</a></li>
                </ul>
            </div>

            <div>
                <h4>Nous joindre</h4>
                <ul>
                    {{-- Le telephone et le courriel sont cliquables : sur un
                         telephone, c'est un appel ; sur un ordinateur, c'est
                         le logiciel de messagerie. Un numero qu'on doit
                         recopier a la main est un numero qu'on n'appelle
                         pas. --}}
                    <li><a href="tel:+33767914587">{{ $societe['telephone'] }}</a></li>
                    <li><a href="mailto:{{ $societe['email'] }}">{{ $societe['email'] }}</a></li>
                    <li><a href="{{ route('contact') }}">Formulaire de contact</a></li>
                    <li><a href="{{ $stores['ios'] }}" rel="noopener">App Store</a></li>
                    <li><a href="{{ $stores['android'] }}" rel="noopener">Google Play</a></li>
                </ul>
            </div>

        </div>

        {{-- Le colophon : la derniere ligne d'un imprime, qui dit qui l'a
             etabli et sous quelle reference. Il ferme le document comme le
             cartouche l'ouvrait — et il repete, a l'endroit ou l'on doute
             le plus, que cette societe existe et se verifie. --}}
        <div class="colophon">
            <span>Document établi par <b>{{ $societe['raison'] }}</b></span>
            <span>{{ $societe['forme'] }} au capital de {{ $societe['capital'] }}</span>
            <span><b>{{ $societe['rcs'] }} {{ $societe['siren'] }}</b></span>
            <span>TVA {{ $societe['tva'] }}</span>
            <span>{{ $societe['code_postal'] }} {{ $societe['ville'] }}</span>
        </div>

        <div class="ourlet">
            <span>
                &copy; {{ date('Y') }} {{ $societe['raison'] }} — {{ $societe['forme'] }}
                au capital de {{ $societe['capital'] }}, {{ $societe['rcs'] }}
                {{ $societe['siren'] }}
            </span>

            <span class="droite">
                <a href="{{ route('legal.mentions') }}">Mentions légales</a>
                <a href="{{ route('legal.cgu') }}">Conditions générales</a>
                <a href="{{ route('legal.confidentialite') }}">Confidentialité</a>
            </span>
        </div>

    </div>
</footer>
