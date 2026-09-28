<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Le formulaire de contact.
 *
 * Il enregistre en base plutot que d'envoyer un courriel, et c'est un
 * choix : un message perdu parce qu'un serveur SMTP etait mal configure ou
 * parce qu'un filtre anti-spam l'a mange est un client perdu sans que
 * personne ne le sache. En base, le message est la ; la notification par
 * courriel peut etre ajoutee ensuite, elle devient un confort et non un
 * point de defaillance unique.
 */
class ContactController extends Controller
{
    public function show(): View
    {
        return view('pages.contact');
    }

    public function store(Request $request): RedirectResponse
    {
        /*
         * Le piege a robots. Le champ « societe » est masque hors de
         * l'ecran et n'est pas tabulable : un humain ne peut pas le
         * remplir, un script automatique le remplit toujours.
         *
         * On repond par une redirection de succes, sans rien enregistrer.
         * Annoncer le rejet apprendrait au robot a contourner le piege.
         * Cette methode ne coute rien au visiteur : ni captcha a resoudre,
         * ni service tiers, ni image illisible pour qui voit mal.
         */
        if ($request->filled('societe')) {
            return redirect()->route('contact')->with('ok', true);
        }

        $donnees = $request->validate([
            'nom'     => ['required', 'string', 'min:2', 'max:80'],
            'email'   => ['required', 'email:rfc', 'max:120'],
            'sujet'   => ['required', 'string', 'in:particulier,professionnel,presse,autre'],
            'message' => ['required', 'string', 'min:20', 'max:4000'],
        ], [
            'nom.required'     => 'Indiquez votre nom, pour qu\'on sache a qui repondre.',
            'nom.min'          => 'Ce nom semble trop court.',
            'email.required'   => 'Sans adresse electronique, aucune reponse ne peut vous parvenir.',
            'email.email'      => 'Cette adresse ne semble pas valide — verifiez l\'arobase et le domaine.',
            'sujet.required'   => 'Choisissez un motif, le message ira plus vite au bon interlocuteur.',
            'message.required' => 'Le message est vide.',
            'message.min'      => 'Quelques mots de plus nous aideraient a vous repondre utilement.',
        ]);

        $message = Message::create($donnees);

        /*
         * Une trace dans le journal, sans le contenu du message : elle sert
         * a verifier que le formulaire fonctionne le jour ou quelqu'un dit
         * « je vous ai ecrit et personne n'a repondu ». Recopier le message
         * dans un journal reviendrait a stocker une donnee personnelle a un
         * deuxieme endroit, pour rien.
         */
        Log::info('Message recu via le formulaire de contact', [
            'id'    => $message->id,
            'sujet' => $message->sujet,
        ]);

        return redirect()->route('contact')->with('ok', true);
    }
}
