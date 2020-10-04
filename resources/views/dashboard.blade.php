@include('components.header')
<h1>Score dashboard</h1>
<div>
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('register')}}">Register</a>
</div>
<x-standings :teams=$teams/>
<x-game_played :data=$date :matches=$matches />
@include('components.footer')
