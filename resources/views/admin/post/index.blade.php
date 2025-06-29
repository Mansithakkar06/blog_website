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
                <th scope="col">image</th>
                <th scope="col">Created By</th>
                <th scope="col">Category</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        <tbody>
            @if (count($posts) != 0)
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ asset('storage/' . $post->image) }}" alt="" height="50"
                                width="50">
                            </td>
                            <td>{{$post->user->name}}</td>
                            <td>@foreach ($post->categories as $category)
                              <span class="badge text-bg-dark">{{$category->name}}</span>
                            @endforeach</td>
                          <td><span class="badge {{ $post->status=="published"?'text-bg-success':($post->status=='draft'?'text-bg-warning':'text-bg-danger') }} ">{{ $post->status }}</span></td>
                        <td><a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a> <a
                                href="#" class="btn btn-danger btn-sm postdlt"
                                data-id="{{ $post->id }}"><i class="fa fa-trash" aria-hidden="true"></i></a> <a href="#" class="btn btn-sm postview"><i class="fa fa-eye" aria-hidden="true"></i></a></td>

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
                                // $("#posttable").load(location.href + " #posttable");
                                    setTimeout(() => {
                            window.location.reload();
                        }, 500);
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
