<x-frontend.master>
    <x-frontend.header image="{{ asset('storage/' . $post->image) }}" title="" subtitle=""
        posttitle="{{ $post->title }}" />
    <div class="row d-flex ms-1 justify-content-between">
        <div class="col-md-8">
            <div class="likeauthor px-2 mx-1">
                <span role="button" class="like px-2 ms-3" data-id="{{ $post->id }}">
                    <i class="{{$liked!=null ? 'fas' : 'far'}} fa-thumbs-up"></i>
                </span>
                <span role="button" class="dislike px-2"><i class="far fa-thumbs-down"
                        data-id="{{ $post->id }}"></i></span>
                <span class="px-2 cmnt"><a href="#commentSection"><i class="far fa-comment"></i></a></span>
                <span class="mx-4" style="font-size: 18px;float: right;"> <img
                        src="{{ asset('storage/' . $post->user->image) }}" width="25" height="25"
                        class="rounded-circle" alt="user image"> <i style="color: #4a5661;">{{ $post->user->name }}</i>
                    <span class="ps-4" style="font-size: 18px;">{{ $post->created_at->diffForHumans() }}</span></span>
            </div>
            <div class="description px-2 mx-3 py-2">
                <p style="text-align: justify;">{!! $post->description !!}</p>
            </div>
            <div class="commentSection px-2 mx-3 py-1" id="commentSection">
                <h3>Comments</h3>
                <div class="commentForm">
                    <div class="input-group mb-3">
                        <input type="text" id="cmntdescription" class="form-control"
                            placeholder="Write your Comment here..." aria-label="comment" aria-describedby="comment">
                        <button class="btn btn-secondary" type="button" id="comment"
                            data-val="{{ $post->id }}"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="allComments" id="allComments">
                    @forelse ($comments as $comment)
                        <x-frontend.comment-card username="{{ $comment->user->name }}"
                            userimage="{{ asset('storage/' . $comment->user->image) }}"
                            description="{{ $comment->description }}" id="{{ $comment->id }}"
                            createdAt="{{ $comment->created_at }}" postid="{{ $post->id }}" />
                    @empty
                        <p style="font-size: 20px;color: #4a5661;">No Comments yet!!</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function() {
                $('#cmntdescription').keyup(function(event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        $('#comment').trigger('click');
                    }
                });
                $(document).on("keyup", ".replydescription", function(event) {
                    if (event.keyCode === 13) {
                        event.preventDefault();
                        $('#replycmnt').trigger('click');
                    }
                });
            });
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });
            $(document).on("click", ".like", function() {
                let postid = $(this).data("id");
                let icon = $(this).find(".fa-thumbs-up");
                icon.toggleClass('far fas');
                let url = "{{route('frontend.removelike','/id')}}";
                url=url.replace("/id",postid);
                if (icon.hasClass("fas")) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('frontend.like') }}",
                        data: {
                            post_id: postid,
                        },
                        success: function(res) {
                            console.log(res);
                        }

                    })
                }
                else{
                    $.ajax({
                        type:"DELETE",
                        url:url,
                        success:function(res){
                            console.log(res);
                        }
                    })
                }
            })
            $(document).on("click", "#comment", function() {
                let url = "{{ route('frontend.comment') }}";
                let postid = $(this).data("val");
                let description = $("#cmntdescription").val();
                if (description.length == 0) {
                    toastr.error("please enter something!!");
                    return;
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        post_id: postid,
                        description: description,
                        reply_id: null,
                    },
                    success: function(res) {
                        setTimeout(() => {
                            $("#allComments").load(location.href + " #allComments");
                        }, 500);
                        $("#cmntdescription").val('');
                    },
                    error: function() {

                    }

                })
            })
            $(document).on("click", ".reply", function() {
                let id = $(this).attr("id");
                $(`#replyform_${id}`).removeClass("d-none");
            })
            $(document).on("click", "#replycmnt", function() {
                let url = "{{ route('frontend.comment') }}";
                let postid = $(this).data("val");
                let cmntid = $(this).data("id");
                let parent = $(this).parents('.replyform');
                let descdataid = $(".replydescription").data("id");
                let formdataid = $(".replyform").data("id");
                if (descdataid == formdataid) {
                    console.log(descdataid, formdataid, cmntid);
                    let description = $(`#replydescription_${descdataid}`).val();
                    console.log(description);
                    if (description.length == 0) {
                        toastr.error("please enter something!!");
                        return;
                    }
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        post_id: postid,
                        reply_id: cmntid,
                        description: description,
                    },
                    success: function(res) {
                        setTimeout(() => {
                            $("#allComments").load(location.href + " #allComments");
                        }, 500);
                        $(".replydescription").val('');
                    },
                    error: function() {

                    }

                })
            })
            $(document).on("click", ".dltcmnt", function() {
                let id = $(this).attr("id");
                let url = "{{ route('frontend.deleteComment', '/id') }}";
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
                                setTimeout(() => {
                                    $("#allComments").load(location.href + " #allComments");
                                }, 500);
                            },
                            error: function(res) {

                            }
                        })
                    }
                });

            })
        </script>
    @endpush
</x-frontend.master>
