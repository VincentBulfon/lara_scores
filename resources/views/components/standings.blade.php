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
            @foreach($stats as $stat)
            <tr>
                <td>
                    <a
                        href="{{route('team_edit', $stat->team_slug)}}"
                        >{{$stat->team_name}}</a
                    >
                </td>
                <td>{{$stat->games }}</td>
                <td>{{$stat->points}}</td>
                <td>{{$stat->wins}}</td>
                <td>{{$stat->losses}}</td>
                <td>{{$stat->draws}}</td>
                <td>{{$stat->goals_for}}</td>
                <td>{{$stat->goals_against}}</td>
                <td>{{$stat->goals_difference}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
