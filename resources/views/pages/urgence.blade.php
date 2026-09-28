@extends('layouts.app')

@section('titre', "Intervention d'urgence")
@section('description', "Fuite, panne de courant, porte claquée, bris de glace : votre demande part en priorité vers les professionnels les plus proches, chacun annoncé son délai avant que vous acceptiez.")

@section('contenu')

<section class="bande">
    <div class="wrap">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Intervention d'urgence</span>
        </nav>

        <div class="urgence-bande">
            <span class="ref">Urgence</span>

            <h1 style="margin:20px 0 20px;max-width:18ch">Quand ça ne peut pas attendre demain matin</h1>

            <p class="lede" style="max-width:62ch">
                Une fuite qui coule, un tableau qui disjoncte, une porte qui
                s'est refermée sur les clés : votre demande est signalée comme
                urgente et part en priorité vers les professionnels les plus
                proches de votre adresse.
            </p>

            <div class="btns" style="margin-top:28px">
                <a class="btn rouge" href="{{ route('telecharger') }}">
                    Télécharger l'application
                </a>
            </div>
        </div>
    </div>
</section>

{{--
    La mise au point sur le delai.

    « Intervention en moins d'une heure » est la promesse qui fait cliquer
    et celle qui fait les mauvais avis. On explique donc de quoi elle
    depend, franchement, avant qu'un client decouvre la nuance a 2 heures
    du matin. Une plateforme qui s'engage sur un delai qu'elle ne maitrise
    pas se brule en trois semaines.
--}}
<section class="bande jour">
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-chapitre rubrique="Le délai, franchement"
                            titre="Ce que veut dire « en moins d'une heure »">
                    Ce n'est pas une garantie contractuelle, et personne ne
                    devrait vous la vendre comme telle.
                </x-chapitre>

                <ul class="puces">
                    <li>
                        <x-icone nom="position" :taille="19" />
                        <span>Votre demande part d'abord vers les professionnels les plus proches, pas vers toute la région.</span>
                    </li>
                    <li>
                        <x-icone nom="horloge" :taille="19" />
                        <span><strong>Chacun annonce son propre délai d'arrivée.</strong> Vous voyez ce chiffre avant d'accepter — c'est lui qui vous engage, pas la promesse affichée sur cette page.</span>
                    </li>
                    <li>
                        <x-icone nom="carte" :taille="19" />
                        <span>Le délai dépend des professionnels réellement disponibles autour de vous à cet instant. Une nuit de tempête n'est pas un mardi après-midi.</span>
                    </li>
                    <li>
                        <x-icone nom="euro" :taille="19" />
                        <span>Une intervention de nuit ou un dimanche coûte plus cher, et ce surcoût est dans le prix annoncé. Pas de majoration découverte sur la facture.</span>
                    </li>
                </ul>
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-urgence.webp') }}"
                     srcset="{{ asset('images/app-urgence.webp') }} 620w, {{ asset('images/app-urgence@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="880" loading="lazy"
                     alt="Le panneau d'urgence de l'application : trois entrées, urgence électrique, urgence de plomberie, urgence en serrurerie.">
            </div>
        </div>
    </div>
</section>

<section class="bande">
    <div class="wrap large">
        <x-chapitre rubrique="Les métiers concernes"
                    titre="Cinq métiers acceptent l'urgence" centre>
            Les autres se réservent aux interventions planifiées : on ne
            repeint pas un salon à minuit, et promettre le contraire ne
            rendrait service à personne.
        </x-chapitre>

        <div class="grille trois">
            @foreach($urgences as $metier)
                <x-carte-metier :metier="$metier" />
            @endforeach
        </div>
    </div>
</section>

{{--
    L'encart des numeros publics.

    Il coute des clients a court terme, et c'est precisement pour cela
    qu'il doit y etre : une plateforme qui laisse quelqu'un publier une
    demande de plomberie alors qu'il sent le gaz est une plateforme
    dangereuse. L'application affiche d'ailleurs le meme rappel, en vert,
    sous son panneau d'urgence.
--}}
<section class="bande jour">
    <div class="wrap">
        <div class="carte" style="border-left:4px solid var(--rouge-lisible);max-width:860px;margin-inline:auto">
            <h2 style="font-size:clamp(1.3rem,2.4vw,1.8rem)">Avant tout : certaines urgences ne sont pas les nôtres</h2>

            <p>
                Crafterlity met en relation avec des artisans. Pour ce qui
                touche à la sécurité des personnes, appelez les services
                publics — c'est gratuit, et c'est plus rapide.
            </p>

            <ul class="puces" style="margin-top:8px">
                <li><x-icone nom="telephone" :taille="19" /><span><strong>15</strong> — SAMU, urgence médicale</span></li>
                <li><x-icone nom="telephone" :taille="19" /><span><strong>18</strong> — pompiers, incendie, inondation qui menace le bâtiment</span></li>
                <li><x-icone nom="telephone" :taille="19" /><span><strong>112</strong> — numéro d'urgence européen</span></li>
                <li><x-icone nom="telephone" :taille="19" /><span><strong>0 800 47 33 33</strong> — urgence sécurité gaz (GRDF), en cas d'odeur de gaz</span></li>
                <li><x-icone nom="telephone" :taille="19" /><span><strong>09 72 67 50 XX</strong> — dépannage électricité Enedis, les deux derniers chiffres étant ceux de votre département</span></li>
            </ul>

            <p class="note" style="margin-top:6px">
                En cas d'odeur de gaz : n'actionnez aucun interrupteur, ouvrez
                les fenêtres, sortez, puis appelez depuis l'extérieur.
            </p>
        </div>
    </div>
</section>

<section class="bande">
    <div class="wrap">
        <x-chapitre rubrique="Zone couverte" titre="Ou l'urgence fonctionne aujourd'hui" centre>
            Le service se déploie depuis la métropole lyonnaise et sa
            périphérie sud, ou se trouvé l'équipe. Ailleurs, la demande part
            quand même : elle trouvera preneur dès qu'un professionnel
            s'inscrira dans votre secteur.
        </x-chapitre>

        <div class="jetons" style="justify-content:center;max-width:820px;margin-inline:auto">
            @foreach($zone as $ville)
                <span class="jeton">{{ $ville }}</span>
            @endforeach
        </div>
    </div>
</section>

@endsection
