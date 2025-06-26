<x-admin.master>
    <x-admin.page-title title="Post" />
    <a href="{{ route('post.create') }}" class="btn btn-primary" id="addpostbtn">Add</a>
    <br>
    <br>
    <table class="table table-bordered" id="posttable">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">slug</th>
                <th scope="col">image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($posts) != 0)
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td><img src="{{ asset('storage/' . $post->image) }}" alt="" height="50"
                                width="50">
                        </td>
                        <td>{{ $post->status }}</td>
                        <td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm">Edit</a> <a
                                href="#" class="btn btn-danger btn-sm postdlt"
                                data-id="{{ $post->id }}">Delete</a></td>

                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center;">No Record Found!!</td>
                </tr>

            @endif
        </tbody>
    </table>

    @push('script')
        <script>
            $(document).on("click", ".postdlt", function() {
                let id = $(this).data("id");
                let url = "{{ route('post.destroy', '/id') }}";
                url = url.replace('/id', id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url: url,
                            success: function(res) {
                                toastr.success(res);
                                $("#posttable").load(location.href + " #posttable");
                            },
                            error: function(res) {
                                toastr.error(res);
                            }
                        })
                    }
                })


            })
        </script>
    @endpush
</x-admin.master>
