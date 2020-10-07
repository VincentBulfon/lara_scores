<nav>
    <h2>Ajouter un match ou une équipe</h2>
    @can('add-match')
    <a href="{{ route('match_create') }}">Ajouter un match</a>
    @endcan @can('add-team')
    <a href="{{ route('team_create') }}">Ajouter une équipe</a>
    @endcan
</nav>
