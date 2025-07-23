@php
    use Carbon\Carbon;
@endphp
<div id="{{ $id }}" class="row my-2 d-flex">
    <div class="col-auto">
        <img src="{{ $userimage }}" width="40" height="40" class="rounded-circle" alt="user image">
    </div>
    <div class="col-auto">
        <p class="m-0" style="font-size: 18px;color: #4a5661;">{{ ucfirst($username) }}</p>
        <p class="m-0" style="font-size: 14px;">{{ $description }}</p>
        @php
            $start = Carbon::parse($createdAt);
            $difference = $start->diffInMinutes(Carbon::now());
        @endphp
        @auth
            <span role="button" class="reply" id="{{ $id }}"
                style="font-size: 14px;color: #4a5661;">Reply</span>
            @if (auth()->user()->id==$userid)
                <span role="button" class="editcmnt mx-1 {{ $difference > 30 ? 'd-none' : '' }}" id="{{ $id }}"
                    style="font-size: 14px;color: #4a5661;">Edit</span>
                <span role="button" class="dltcmnt {{ $difference > 30 ? 'd-none' : '' }}" id="{{ $id }}"
                    style="font-size: 14px;color: #4a5661;">Delete</span>
                @endif

        @endauth
        <div class="replyform d-none" id="replyform_{{ $id }}" data-id="{{ $id }}">
            <div class="input-group mb-3">
                <input type="text" id="replydescription_{{ $id }}" class="form-control replydescription"
                    placeholder="Write your Reply here..." aria-label="replycmnt" aria-describedby="replycmnt"
                    data-id={{ $id }}>
                <button class="btn btn-secondary replycmnt" type="button" id="replycmnt" data-val="{{ $postid }}"
                    data-id="{{ $id }}"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                </button>
            </div>
        </div>
        <div class="editcmntform d-none" id="editcmntform_{{ $id }}" data-id="{{ $id }}">
            <div class="input-group mb-3">
                <input type="text" id="editdescription_{{ $id }}" class="form-control editdescription"
                    aria-label="updatecomment" aria-describedby="updatecomment" data-id={{ $id }}>
                <button class="btn btn-secondary updatecomment" type="button" id="updatecomment" data-val="{{ $postid }}"
                    data-id="{{ $id }}"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="ms-5">
     @foreach ($replies as $reply)
        <x-frontend.comment-card username="{{ $reply->user->name }}"
            userimage="{{ asset('storage/' . $reply->user->image) }}" description="{{ $reply->description }}"
            id="{{ $reply->id }}" createdAt="{{ $reply->created_at }}" postid="{{ $postid }}"
            :replies="$reply->reply" userid="{{$reply->user_id}}" />
    @endforeach
</div>
