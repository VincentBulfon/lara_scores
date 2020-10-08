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
    <p>
        Unlisted team ?
        <a href="{{ route('team_create') }}">I want to add a team.</a>
    </p>
</div>
<form action="/match" method="POST">
    @csrf
    <label for="played-at">Date of the match&nbsp;:</label>
    <input type="date" name="played-at" id="played-at" />
    @error('played_at')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <fieldset>
        <legend>Home Team</legend>
        <label for="home-team">Team name &nbsp;:</label>
        @if($teams)
        <select name="home-team" id="home-team">
            @foreach($teams as $team)
            <option value="{{$team->slug}}">{{$team->name}}</option>
            @endforeach
        </select>
        @endif @error('home-team')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="home-team-goals">Goals&nbsp;:</label>
        <input type="number" name="home-team-goals" id="home-team-goals" />
        @error('home-team-goals')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </fieldset>
    <fieldset>
        <legend>Away Team</legend>
        <label for="away-team">Team name &nbsp;:</label>
        @if($teams)
        <select name="away-team" id="away-team">
            @foreach($teams as $team)
            <option value="{{$team->slug}}">{{$team->name}}</option>
            @endforeach
        </select>
        @endif @error('away-team')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label for="away-team-goals">Goals&nbsp;:</label>
        <input type="number" name="away-team-goals" id="away-team-goals" />
        @error('away-team-goals')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </fieldset>
    <button type="submit">Enregistrer le match</button>
</form>

@include('components.footer')
