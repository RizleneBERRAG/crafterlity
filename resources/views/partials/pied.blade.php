@php
    $societe = config('crafterlity.societe');
    $stores  = config('crafterlity.stores');
@endphp

{{--
    Le pied de page.

    La version precedente empilait quatre colonnes de liens, un colophon et
    un ourlet — et les deux derniers disaient la MEME CHOSE : la forme
    juridique, le capital, le RCS, une fois en chasse fixe, une fois en
    texte courant. Un pied de page qui se repete donne l'impression d'un
    gabarit qu'on n'a pas relu.

    Il tient maintenant en trois temps : un appel, des liens, une ligne
    legale. Et cette ligne ne parait qu'une fois.
--}}

<footer class="pied">
    <div class="wrap">

        {{-- 1. l'appel. Le pied de page est le dernier endroit ou l'on peut
               rattraper quelqu'un qui a tout lu sans rien faire. --}}
        <div class="pied-tete">
            <div>
                <x-logo titre="Crafterlity" />
                <p class="signature">
                    Trouvez un artisan vérifié pour vos travaux et vos dépannages
                    à domicile. Décrivez votre besoin, recevez des propositions,
                    suivez l'intervention.
                </p>
            </div>

            <x-stores />
        </div>

        <div class="piedin">

            <div>
                <h4>Services</h4>
                <ul>
                    @foreach(collect(config('metiers'))->take(5) as $metier)
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
                         recopier a la main est un numero qu'on n'appelle pas. --}}
                    <li><a href="tel:+33767914587">{{ $societe['telephone'] }}</a></li>
                    <li><a href="mailto:{{ $societe['email'] }}">{{ $societe['email'] }}</a></li>
                    <li><a href="{{ route('contact') }}">Formulaire de contact</a></li>
                    <li>{{ $societe['adresse'] }}<br>{{ $societe['code_postal'] }} {{ $societe['ville'] }}</li>
                </ul>
            </div>

        </div>

        {{-- 3. la ligne legale, et elle ne parait qu'une fois. Les
               identifiants restent en chasse fixe : ce sont des numeros,
               on les recopie. --}}
        <div class="ourlet">
            <p class="ourlet-legal">
                &copy; {{ date('Y') }} {{ $societe['raison'] }} ·
                {{ $societe['forme'] }} au capital de {{ $societe['capital'] }} ·
                <span class="mono">{{ $societe['rcs'] }} {{ $societe['siren'] }}</span> ·
                <span class="mono">TVA {{ $societe['tva'] }}</span>
            </p>

            <nav class="ourlet-liens" aria-label="Informations légales">
                <a href="{{ route('legal.mentions') }}">Mentions légales</a>
                <a href="{{ route('legal.cgu') }}">Conditions générales</a>
                <a href="{{ route('legal.confidentialite') }}">Confidentialité</a>
            </nav>
        </div>

    </div>
</footer>
