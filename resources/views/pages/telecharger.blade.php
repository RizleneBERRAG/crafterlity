@extends('layouts.app')

@section('titre', "Télécharger l'application")
@section('description', "Crafterlity est disponible gratuitement sur l'App Store et Google Play. Créez votre compte en quelques secondes, pour demander une intervention ou proposer vos services.")

@section('contenu')

<section class="hero" data-anime>

    <div class="wrap heroin">
        <div>
            <nav class="ariane" aria-label="Fil d'Ariane">
                <a href="{{ route('accueil') }}">Accueil</a>
                <span aria-hidden="true">/</span>
                <span>Télécharger</span>
            </nav>

            <h1>L'application, <span class="or">gratuitement</span>.</h1>

            <p class="hero-lede">
                Un seul téléchargement pour les deux usages : demander une
                intervention chez soi, ou recevoir des missions en tant que
                professionnel. Vous choisissez votre role à la création du
                compte, et vous pouvez en changer.
            </p>

            <x-stores />

            <p class="note" style="margin-top:22px">
                iOS 16.4 ou plus récent · Android · Français et anglais ·
                Aucun achat intégré
            </p>
        </div>

        <div class="hero-visuel">
            <img src="{{ asset('images/app-accueil.webp') }}"
                 srcset="{{ asset('images/app-accueil.webp') }} 620w, {{ asset('images/app-accueil@2x.webp') }} 1240w"
                 sizes="(max-width: 920px) 58vw, 330px"
                 width="620" height="1030" fetchpriority="high"
                 alt="L'écran d'accueil de l'application Crafterlity.">
        </div>
    </div>
</section>

<section class="bande jour" data-anime>
    <div class="wrap large">
        <x-chapitre rubrique="Dans l'application" titre="Ce que vous y trouverez" centre />

        <div class="grille quatre">
            <div class="carte">
                <span class="icone"><x-icone nom="appareil" :taille="23" /></span>
                <h3>Demander</h3>
                <p>Une catégorie, une description, des photos, un créneau, une adresse. Deux minutes, sans appel.</p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="euro" :taille="23" /></span>
                <h3>Comparer</h3>
                <p>Les offres arrivent avec un prix ferme, un délai et le profil du professionnel.</p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="position" :taille="23" /></span>
                <h3>Suivre</h3>
                <p>Le trajet du technicien s'affiche en direct, avec une heure d'arrivée recalculée en route.</p>
            </div>

            <div class="carte">
                <span class="icone"><x-icone nom="bouclier" :taille="23" /></span>
                <h3>Payer</h3>
                <p>Par carte, dans l'application, via Stripe. Le professionnel est versé une fois la mission terminée.</p>
            </div>
        </div>
    </div>
</section>

<section class="bande" data-anime>
    <div class="wrap">
        <div class="duo">
            <div class="duo-texte">
                <x-chapitre rubrique="Avant d'installer"
                            titre="Les autorisations que l'application demande">
                    Chacune correspond à une fonction précise, et chacune se
                    refuse depuis les réglages de votre téléphone.
                </x-chapitre>

                <ul class="puces">
                    <li>
                        <x-icone nom="position" :taille="19" />
                        <span><strong>La position</strong> — pour renseigner l'adresse d'intervention et calculer les distances. Pour un professionnel, elle n'est suivie en arrière-plan que pendant le trajet d'une mission acceptée, et le suivi s'arrete avec elle.</span>
                    </li>
                    <li>
                        <x-icone nom="appareil" :taille="19" />
                        <span><strong>L'appareil photo et la photothèque</strong> — uniquement les images que vous choisissez d'ajouter à une demande.</span>
                    </li>
                    <li>
                        <x-icone nom="courriel" :taille="19" />
                        <span><strong>Les notifications</strong> — les offres reçues, les messages, les changements de statut d'une intervention.</span>
                    </li>
                </ul>

                <p style="margin-top:22px">
                    <a class="suite" href="{{ route('legal.confidentialite') }}">
                        Lire la politique de confidentialité
                        <x-icone nom="fleche" :taille="17" />
                    </a>
                </p>
            </div>

            <div class="duo-visuel">
                <img src="{{ asset('images/app-categories.webp') }}"
                     srcset="{{ asset('images/app-categories.webp') }} 620w, {{ asset('images/app-categories@2x.webp') }} 1240w"
                     sizes="(max-width: 920px) 72vw, 300px"
                     width="620" height="962" loading="lazy"
                     alt="L'accueil de l'application, avec l'adresse d'intervention et les catégories les plus recherchées.">
            </div>
        </div>
    </div>
</section>

<section class="bande jour serree" data-anime>
    <div class="wrap">
        <div class="carte" style="max-width:760px;margin-inline:auto;text-align:center;align-items:center">
            <h2 style="font-size:clamp(1.3rem,2.4vw,1.8rem)">Pas de téléphone sous la main ?</h2>
            <p>
                Le service fonctionne aujourd'hui depuis l'application mobile.
                Pour une question, une demande particulière ou un partenariat,
                écrivez-nous : quelqu'un lit et répond.
            </p>
            <div class="btns centre" style="margin-top:8px">
                <a class="btn creux" href="{{ route('contact') }}">Nous écrire</a>
                <a class="btn creux" href="tel:+33767914587">
                    {{ config('crafterlity.societe.telephone') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
