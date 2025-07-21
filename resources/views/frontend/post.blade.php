<x-frontend.master>
    <x-frontend.header image="{{ asset('storage/' . $post->image) }}" title="" subtitle="{{ $post->title }}" />
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="likeauthor px-2 mx-3">
                    <span role="button" class="like px-2 ms-3" data-id="{{$post->id}}">
                        <i class="fa-regular fa-thumbs-up"></i>
                        {{-- <i class="fa-solid fa-thumbs-up"></i> --}}
                    </span>
                    <span role="button" class="px-2"><i class="fa-regular fa-thumbs-down" data-id="{{$post->id}}"></i></span>
                    <span class="m-4" style="font-size: 18px;float: right;"> <img
                            src="{{ asset('storage/' . $post->user->image) }}" width="25" height="25"
                            class="rounded-circle" alt="user image"> <i
                            style="color: #4a5661;">{{ $post->user->name }}</i> <span class="ps-4" style="font-size: 18px;">{{ $post->created_at->diffForHUmans() }}</span></span>
                <div class="description px-2 mx-3 py-3">
                    <p style="text-align: justify;">{!! $post->description !!}</p>
                </div>
            </div>
        </div>
    </div>
    @push('script')
    <script>
        $(document).on("click",".like",function(){
            let postid=$(this).data("id");
            console.log(postid);
        })
    </script>
    @endpush
</x-frontend.master>
