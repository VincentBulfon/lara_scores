@include('components.header')
<h1>Score dashboard</h1>

<x-standings :teams=$teams/>
<x-game_played :data=$date :matches=$matches />
@include('components.footer')
