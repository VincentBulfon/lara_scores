@include('components.header')
<h1>Add a team</h1>

<form action="#TODO" method="put" enctype="multipart/form-data">
    @csrf
    <label for="name">Name of the team&nbsp;:</label>
    <input type="text" name="name" id="name" value="{{$team->name}}" />
    @error('name')
    <p>{{ $message }}</p>
    @enderror
    <label for="slug">Slug&nbsp;:</label>
    <input type="text" name="slug" id="slug" value="{{$team->slug}}" />
    @error('name')
    <p>{{ $message }}</p>
    @enderror
    <label for="flag">Flag&nbsp;:</label>
    <input type="file" name="file" id="flag" />
    @error('file_name')
    <p>{{ $message }}</p>
    @enderror
    <button type="submit">Add team</button>
</form>

@include('components.footer')
