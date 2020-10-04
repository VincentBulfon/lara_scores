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
            <!-- TODO -->
            @foreach($teams as $team)
            <tr>
                <td>{{$team->name}}</td>
                <td>{{$team->TotalGames }}</td>
                <td>{{$team->goals}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>{{$team->GoalsFor}}</td>
                <td>{{$team->GoalsAgainst}}</td>
                <td>{{$team->GoalsDifference}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
