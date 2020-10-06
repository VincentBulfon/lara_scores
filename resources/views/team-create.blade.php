@include('components.header')
<h1>Add a team</h1>

<form
    action="{{ route('team_store') }}"
    method="post"
    enctype="multipart/form-data"
>
    @csrf
    <label for="name">Name of the team&nbsp;:</label>
    <input type="text" name="name" id="name" />
    @error('name')
    <p>{{ $message }}</p>
    @enderror
    <label for="slug">Slug&nbsp;:</label>
    <input type="text" name="name" id="slug" />
    @error('name')
    <p>{{ $message }}</p>
    @enderror
    <label for="flag">Flag&nbsp;:</label>
    <input type="file" name="file_name" id="flag" />
    @error('file_name')
    <p>{{ $message }}</p>
    @enderror
    <button type="submit">Add team</button>
</form>

@include('components.footer')
