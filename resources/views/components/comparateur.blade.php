@php
    $avant = config('comparaison.avant');
    $apres = config('comparaison.apres');
@endphp

{{--
    Le meme mardi matin, raconte deux fois.

    Les lignes portent « data-ligne » avec leur rang : le script les
    imprime en alternance d'une colonne a l'autre, pour qu'on voie la
    matinee se derouler des deux cotes en meme temps. Sans script, elles
    sont simplement toutes la.
--}}

<div class="compare" data-compare>
    @foreach([['avant', $avant, ''], ['apres', $apres, ' compare-col--nous']] as [$cle, $col, $classe])
        <section class="compare-col{{ $classe }}">
            <header class="compare-tete">
                <h3>{{ $col['titre'] }}</h3>
                <span class="compare-quoi">{{ $col['quoi'] }}</span>
            </header>

            <ol class="compare-lignes">
                @foreach($col['lignes'] as $i => $ligne)
                    <li class="compare-ligne" data-ligne="{{ $i }}">
                        <span class="compare-h">{{ $ligne['h'] }}</span>
                        <span class="compare-t">{{ $ligne['t'] }}</span>
                    </li>
                @endforeach
            </ol>

            <footer class="compare-pied">
                <span class="compare-total">{{ $col['total'] }}</span>
                <span class="compare-note">{{ $col['note'] }}</span>
            </footer>
        </section>
    @endforeach
</div>
