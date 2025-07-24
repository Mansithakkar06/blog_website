<x-admin.master>
    <x-admin.page-title title="Comment" />
         <table class="table table-bordered" id="cattable">
        <thead class="thead-light">
            <tr>
                <th scope="col">
                    id
                      {{-- <span class="text-sm float-end">
                        <a href="{{ route('category.index',['sort_by'=>'id','direction'=>'asc']) }}" class="{{$sort_by=='id' && $direction=='asc' ? 'text-muted':''}}" style="color: gray;"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('category.index',['sort_by'=>'id','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='id' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span> --}}
                </th>
                <th scope="col">
                    Description
                       {{-- <span class="text-sm float-end">
                        <a href="{{ route('category.index',['sort_by'=>'name','direction'=>'asc']) }}" class="{{$sort_by=='name' && $direction=='asc' ? 'text-muted':''}}" style="color: gray;"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('category.index',['sort_by'=>'name','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='name' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span> --}}
                </th>
                <th scope="col">User</th>
                <th scope="col">Post</th>
                <th scope="col">
                    Status
                       {{-- <span class="text-sm float-end">
                        <a href="{{ route('category.index',['sort_by'=>'status','direction'=>'asc']) }}" class="{{$sort_by=='status' && $direction=='asc' ? 'text-muted':''}}" style="color: gray;"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
                        <a href="{{ route('category.index',['sort_by'=>'status','direction'=>'desc']) }}" style="color: gray;" class="{{$sort_by=='status' && $direction=='desc' ? 'text-muted':''}}"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
                    </span> --}}
                </th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($comments) != 0)
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $comment->id }}</th>
                        <td>{{ $comment->description }}</td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ $comment->post_id}}</td>
                        <td><select name="status" id="status" class="form-control" data-id="{{$comment->id}}">
                            <option value="approved" {{$comment->status=="approved"?'selected':''}}>Approved</option>
                            <option value="declined" {{$comment->status=="declined"?'selected':''}}>Declined</option>
                        </select></td>
                        <td><a href="#" data-id="{{ $comment->id }}"
                                class="btn btn-danger btn-sm dltbtn"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
            $(document).on("change","#status",function(){
                let val=$(this).val();
                let id=$(this).data("id");
                $.ajax({
                    type:"POST",
                    url:"{{route('comment.update')}}",
                    data:{
                        'id':id,
                        'status':val,
                    },
                    success:function(res){
                        setTimeout(() => {
                            window.location.reload();
                        }, 500);
                    },
                    error:function(res){

                    }
                })
            })
        </script>
    @endpush
</x-admin.master>
