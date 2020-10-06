@include('components.header')
<h1>Create a new match</h1>
<div>
    @if($teams)
    <ul>
        @foreach($teams as $team)
        <li>{{$team->name}}</li>
        @endforeach
    </ul>
    @endif
    <p>Equipe non listée ?</p>
    <a href="{{ route('team_create') }}">Ajouter une équipe</a>
</div>
<form action="/matches" method="POST">
    @csrf
    <fieldset>
        <legend>Home Team</legend>
        <label for="homeTeam">Team name &nbsp;:</label>
        @if($teams)
        <select name="homeTeam" id="homeTeam">
            @foreach($teams as $team)
            <option value="{{$team->slug}}">{{$team->name}}</option>
            @endforeach
        </select>
        @endif
        <label for="homeTeamGoals">Goals&nbsp;:</label>
        <input type="number" name="homeTeamGoals" id="homeTeamGoals" />
    </fieldset>
    <fieldset>
        <legend>Away Team</legend>
        <label for="awayTeam">Team name &nbsp;:</label>
        @if($teams)
        <select name="awayTeam" id="awayTeam">
            @foreach($teams as $team)
            <option value="{{$team->slug}}">{{$team->name}}</option>
            @endforeach
        </select>
        @endif
        <label for="awayTeamGoals">Goals&nbsp;:</label>
        <input type="number" name="awayTeamGoals" id="awayTeamGoals" />
    </fieldset>
    <button type="submit">Enregistrer le match</button>
</form>

@include('components.footer')
