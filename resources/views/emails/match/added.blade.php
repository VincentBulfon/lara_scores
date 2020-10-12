<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>A new match has been created</title>
    </head>
    <body>
        <h1>Hi! A new match has been created</h1Hi>
        <h2>Details</h2>
        <ul>
            <li>Name&nbsp;: {{$match->played_at}}</li>
            <li>Slug&nbsp;: {{$match->slug}}</li>
        </ul>
    </body>
</html>
