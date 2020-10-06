@include('components.header')
<h1>Score dashboard</h1>
@guest()
<div>
        <a href="{{route('login')}}">Login</a>
        <a href="{{route('register')}}">Register</a>
</div>
@endguest()
<x-standings :teams=$teams/>
<x-game_played :data=$date :matches=$matches />
<hr>
@auth()
@include('components.create')
<hr>
<form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
</form>
@endauth()
@include('components.footer')
