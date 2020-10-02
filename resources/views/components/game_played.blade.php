<section>
    <h2>Games played at {{ $data }}</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Home Team</th>
                <th>Home Team Goals</th>
                <th>Away Team Goals</th>
                <th>Away Team</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matches as $match)
            <tr>
                <td>{{$match->played_at}}</td>
                <td>{{$match->isHomeTeam}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</section>
