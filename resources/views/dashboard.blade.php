@include('components.header')
<h1>Score dashboard</h1>
<x-standings/>
<x-game_played :data=$date :matches=$matches />
@include('components.footer')
