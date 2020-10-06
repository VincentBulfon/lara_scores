@include('components.header')
<section>
    <h2>Ajouter un match ou une équipe</h2>
    <a href="{{ route('match_create') }}">Ajouter un match</a>
    <a href="{{ route('team_create') }}">Ajouter une équipe</a>
</section>
@include('components.footer')
