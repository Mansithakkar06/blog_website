<x-admin.master>
    <x-admin.page-title title="Post" />
    <a href="{{ route('post.create') }}" class="btn btn-primary" id="addpostbtn">Add</a>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">slug</th>
                <th scope="col">image</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{ $post->id }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>{{ $post->image }}</td>
                    <td>{{ $post->title }}</td>

                </tr>
            @endforeach
        </tbody>

        @push('script')
            <script></script>
        @endpush
</x-admin.master>
