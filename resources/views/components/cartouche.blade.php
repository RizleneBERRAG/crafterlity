@php $s = config('crafterlity.societe'); @endphp

{{--
    Le cartouche : l'en-tete d'un document officiel — qui emet, sur quel
    objet, sous quelle reference, a quelle date.

    Chaque valeur est vraie et verifiable. C'est ce qui separe ce bandeau
    d'un costume : le SIREN se controle en trente secondes sur l'annuaire
    des entreprises, et c'est precisement ce qu'on veut qu'un visiteur
    mefiant fasse.

    Sur telephone, il se replie en une ligne : les intitules disparaissent
    et deux fragments s'effacent — la metropole et l'objet, que le titre
    juste en dessous dit deja en mieux. Un cartouche s'annonce, il ne se
    lit pas.
--}}

<dl class="cartouche">
    <div>
        <dt>Éditeur</dt>
        <dd>{{ $s['raison'] }}<span class="cartouche-long"> · {{ $s['forme'] }}</span></dd>
    </div>
    <div>
        <dt>Immatriculation</dt>
        <dd>SIREN {{ $s['siren'] }}</dd>
    </div>
    <div>
        <dt>Établissement</dt>
        <dd>{{ $s['ville'] }} ({{ substr($s['code_postal'], 0, 2) }})<span class="cartouche-long"> · Métropole de Lyon</span></dd>
    </div>
    <div class="cartouche-objet">
        <dt>Objet</dt>
        <dd>Mise en relation · Travaux et dépannage</dd>
    </div>
</dl>
