<x-admin.master>
    <x-admin.page-title title="Post" />
    <a href="{{ route('post.create') }}" class="btn btn-primary" id="addpostbtn">Add</a>
    <br>
    <br>
    <table class="table table-bordered" id="posttable">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    id
                    <span class="text-sm float-end">
                        <a href="{{ route('post.index',['sort_by'=>'id','direction'=>'asc']) }}" style="color: gray;" class="{{$sort_by=='id' && $direction=='asc' ? 'text-muted':''}}"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('post.index',['sort_by'=>'id','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='id' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span>
                 </th>
                <th scope="col" style="width:25%;">
                    Title
                     <span class="text-sm float-end">
                        <a href="{{ route('post.index',['sort_by'=>'title','direction'=>'asc']) }}" class="{{$sort_by=='title' && $direction=='asc' ? 'text-muted':''}}" style="color: gray;"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('post.index',['sort_by'=>'title','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='title' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span>
                </th>
                <th scope="col">image</th>
                <th scope="col">Created By</th>
                <th scope="col">Category</th>
                <th scope="col">
                    Status
                     <span class="text-sm float-end">
                        <a href="{{ route('post.index',['sort_by'=>'status','direction'=>'asc']) }}" class="{{$sort_by=='status' && $direction=='asc' ? 'text-muted':''}}" style="color: gray;"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('post.index',['sort_by'=>'status','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='status' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span>
                </th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($posts) != 0)
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td><img src="{{ asset('storage/' . $post->image) }}" alt="" height="50"
                                width="50">
                        </td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            @foreach ($post->categories as $category)
                                <span class="badge text-bg-dark">{{ $category->name }}</span>
                            @endforeach
                        </td>
                        <td><span
                                class="badge {{ $post->status == 'published' ? 'text-bg-success' : ($post->status == 'draft' ? 'text-bg-warning' : 'text-bg-danger') }} ">{{ $post->status }}</span>
                        </td>
                        <td>
                            <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm"><i
                                    class="fas fa-edit"></i></a>
                            <a href="#" class="btn btn-danger btn-sm postdlt" data-id="{{ $post->id }}"><i
                                    class="fa fa-trash" aria-hidden="true"></i></a>
                            <a href="" class="btn btn-sm postview openModal" data-toggle="modal" data-id="{{ $post->id }}" data-url="{{ route('post.show',$post->id) }}"  data-title="{{ $post->title }}" data-type="GET" ><i
                                    class="fa fa-eye" aria-hidden="true"></i></a>
                        </td>

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
            // $(document).on("click",".postview",function(){
            //     let id=$(this).data("id");
            //     let url="{{ route('post.show','/id') }}";
            //     url=url.replace('/id',id);
            //     $.ajax({
            //         type:"GET",
            //         url:url,
            //         success:function(res){
            //             console.log(res);
            //         }
            //     })

            // })
        </script>
    @endpush
</x-admin.master>
