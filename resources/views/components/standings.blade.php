<section>
    <h2>Standings</h2>
    <table>
        <thead>
            <tr>
                <th scope="col">Team</th>
                <th scope="col">Games</th>
                <th scope="col">Points</th>
                <th scope="col">Wins</th>
                <th scope="col">Losses</th>
                <th scope="col">Draws</th>
                <th scope="col">GF</th>
                <th scope="col">GA</th>
                <th scope="col">GD</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{$team->name}}</td>
                <td>{{$team->totalGames }}</td>
                <td>{{$team->points}}</td>
                <td>{{$team->wins}}</td>
                <td>{{$team->loses}}</td>
                <td>{{$team->draws}}</td>
                <td>{{$team->goalsFor}}</td>
                <td>{{$team->goalsAgainst}}</td>
                <td>{{$team->goalsDifference}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
