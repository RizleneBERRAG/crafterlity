@extends('layouts.app')

@section('titre', 'Contact')
@section('description', "Une question sur une intervention, un paiement, votre compte ou vos données personnelles ? Écrivez à l'équipe Crafterlity, à Ternay dans le Rhône.")

@section('contenu')

@php $societe = config('crafterlity.societe'); @endphp

<section class="bande serree">
    <div class="wrap">
        <nav class="ariane" aria-label="Fil d'Ariane">
            <a href="{{ route('accueil') }}">Accueil</a>
            <span aria-hidden="true">/</span>
            <span>Contact</span>
        </nav>

        <x-chapitre rubrique="Nous joindre" titre="Quelqu'un lit, et répond" niveau="h1">
            Pour une question sur votre compte, une mission, un paiement, vos
            données personnelles, ou pour nous signaler quelque chose qui ne
            va pas.
        </x-chapitre>
    </div>
</section>

<section class="bande jour">
    <div class="wrap">
        <div class="duo">

            <div class="duo-texte">
                {{--
                    Le message de succes reprend le focus.

                    Apres un envoi, la page se recharge et le lecteur d'ecran
                    repart du haut : sans role="status" et sans tabindex, le
                    visiteur aveugle n'a aucun moyen de savoir que son
                    message est parti. C'est le genre d'oubli qui ne se voit
                    jamais a l'oeil.
                --}}
                @if(session('ok'))
                    <div class="message ok" role="status" tabindex="-1" autofocus>
                        <x-icone nom="coche" :taille="20" />
                        <span>
                            <strong>Message envoyé.</strong>
                            Nous revenons vers vous à l'adresse indiquée, en
                            général sous un jour ouvre.
                        </span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="message ko" role="alert" tabindex="-1">
                        <x-icone nom="fleche" :taille="20" />
                        <span>
                            <strong>Le message n'a pas pu être envoyé.</strong>
                            Les champs à corriger sont signalés ci-dessous.
                        </span>
                    </div>
                @endif

                <form class="form" method="post" action="{{ route('contact.store') }}" novalidate>
                    @csrf

                    {{--
                        Le piege a robots. Masque hors de l'ecran et retire
                        du parcours de tabulation : un humain ne peut pas le
                        remplir, un script automatique le remplit toujours.

                        aria-hidden et tabindex="-1" le rendent invisible
                        aussi pour une synthese vocale — sans quoi le piege
                        se refermerait sur les visiteurs aveugles, qui sont
                        precisement ceux qu'un captcha visuel exclut deja.
                    --}}
                    <div class="abeille" aria-hidden="true">
                        <label for="societe">Ne remplissez pas ce champ</label>
                        <input type="text" id="societe" name="societe" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="duo-champs">
                        <div class="champ">
                            <label for="nom">Votre nom</label>
                            <input type="text" id="nom" name="nom" required
                                   autocomplete="name" value="{{ old('nom') }}"
                                   @error('nom') aria-invalid="true" aria-describedby="err-nom" @enderror>
                            @error('nom')
                                <span class="erreur" id="err-nom">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="champ">
                            <label for="email">Votre adresse électronique</label>
                            <input type="email" id="email" name="email" required
                                   autocomplete="email" value="{{ old('email') }}"
                                   @error('email') aria-invalid="true" aria-describedby="err-email" @enderror>
                            @error('email')
                                <span class="erreur" id="err-email">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="champ">
                        <label for="sujet">Vous écrivez en tant que</label>
                        <select id="sujet" name="sujet" required
                                @error('sujet') aria-invalid="true" @enderror>
                            <option value="particulier" @selected(old('sujet') === 'particulier')>Particulier — une question sur une intervention</option>
                            <option value="professionnel" @selected(old('sujet') === 'professionnel')>Artisan — inscription, missions, versements</option>
                            <option value="presse" @selected(old('sujet') === 'presse')>Presse ou partenariat</option>
                            <option value="autre" @selected(old('sujet') === 'autre')>Autre sujet</option>
                        </select>
                        @error('sujet')
                            <span class="erreur">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="champ">
                        <label for="message">Votre message</label>
                        <span class="aide">
                            Si votre question concerne une intervention
                            précise, indiquez l'adresse électronique du compte
                            et la date : cela évite un aller-retour.
                        </span>
                        <textarea id="message" name="message" required minlength="20"
                                  @error('message') aria-invalid="true" aria-describedby="err-message" @enderror>{{ old('message') }}</textarea>
                        @error('message')
                            <span class="erreur" id="err-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="btn or">Envoyer le message</button>
                    </div>

                    <p class="note">
                        Les informations saisies servent uniquement à traiter
                        votre demande. Vous pouvez en demander l'accès, la
                        rectification ou la suppression à
                        <a href="mailto:{{ $societe['email'] }}" style="color:var(--or-profond)">{{ $societe['email'] }}</a>.
                    </p>
                </form>
            </div>

            <div>
                <div class="carte">
                    <h3>Directement</h3>

                    <ul class="puces">
                        <li>
                            <x-icone nom="courriel" :taille="19" />
                            <span><a href="mailto:{{ $societe['email'] }}">{{ $societe['email'] }}</a></span>
                        </li>
                        <li>
                            <x-icone nom="telephone" :taille="19" />
                            <span><a href="tel:+33767914587">{{ $societe['telephone'] }}</a></span>
                        </li>
                        <li>
                            <x-icone nom="position" :taille="19" />
                            <span>
                                {{ $societe['adresse'] }}<br>
                                {{ $societe['code_postal'] }} {{ $societe['ville'] }}
                            </span>
                        </li>
                    </ul>
                </div>

                <div class="carte" style="margin-top:18px">
                    <h3>Supprimer votre compte</h3>
                    <p>
                        Écrivez à {{ $societe['email'] }} avec pour objet
                        « Suppression de compte Crafterlity ». Des informations
                        complémentaires pourront vous être demandées afin de
                        vérifier votre identité.
                    </p>
                </div>

                <div class="carte" style="margin-top:18px">
                    <h3>Une urgence en cours ?</h3>
                    <p>
                        Ce formulaire n'est pas un canal d'urgence. Pour une
                        intervention immédiate, passez par l'application ; pour
                        la sécurité des personnes, appelez le 15, le 18 ou le 112.
                    </p>
                    <a class="suite" href="{{ route('urgence') }}">
                        Les numéros utiles
                        <x-icone nom="fleche" :taille="17" />
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
