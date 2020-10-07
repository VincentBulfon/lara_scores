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
@canany(['add-match', 'add-team'])
@include('components.create')
@endcanany
<hr>
<form action="{{route('logout')}}" method="POST">
        @csrf
        <button type="submit">Logout</button>
</form>
@endauth()
@include('components.footer')
