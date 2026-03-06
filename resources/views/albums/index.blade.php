<x-app-layout>

<a href="{{ route('albums.create') }}" class="btn btn-primary mb-3">Create Album</a>

<table class="table table-bordered">
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Public</th>
        <th>Action</th>
    </tr>

    @foreach($albums as $album)
    <tr>
        <td>{{ $album->title }}</td>
        <td>{{ $album->status }}</td>
        <td>{{ $album->is_public ? 'Yes' : 'No' }}</td>
        <td>
            <a href="{{ route('albums.edit',$album) }}" class="btn btn-warning btn-sm">Edit</a>

            <form action="{{ route('albums.destroy',$album) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</x-app-layout>