<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->string('email', 120);

            /*
             * Le motif, en chaine courte plutot qu'en enum SQL : un enum se
             * modifie par une migration a chaque nouveau motif, la ou une
             * chaine validee cote applicatif se modifie dans la regle de
             * validation. Le jour ou « partenariat » s'ajoute, rien a
             * migrer.
             */
            $table->string('sujet', 20);
            $table->text('message');

            /*
             * Pas d'adresse IP stockee. La limitation de debit vit dans le
             * cache et n'a pas besoin qu'on la conserve ; garder une IP
             * aupres d'un message reviendrait a collecter une donnee
             * personnelle supplementaire sans finalite qu'on puisse
             * justifier.
             */
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
