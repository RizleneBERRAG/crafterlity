@props(['metier'])

<a class="carte" href="{{ route('metiers.show', $metier['slug']) }}">
    @if($metier['urgence'])
        {{-- Le fanion ne se pose que sur les metiers qui acceptent
             reellement l'intervention immediate. L'afficher partout le
             viderait de son sens, et decevrait le premier client qui
             cliquerait sur « peinture » a 23 heures. --}}
        <span class="fanion">Urgence</span>
    @endif

    <span class="icone"><x-icone :nom="$metier['slug']" :taille="23" /></span>

    <h3>{{ $metier['nom'] }}</h3>
    <p>{{ $metier['resume'] }}</p>

    <span class="suite">
        Voir les interventions
        <x-icone nom="fleche" :taille="17" />
    </span>
</a>
