@php
    use Carbon\Carbon;
@endphp
<div id="{{ $id }}" class="row my-4 d-flex">
    <div class="col-md-1">
        <img src="{{ $userimage }}" width="45" height="45" class="rounded-circle" alt="user image">
    </div>
    <div class="col-md-6">
        <p class="m-0" style="font-size: 20px;color: #4a5661;">{{ $username }}</p>
        <p class="m-0" style="font-size: 16px;">{{ $description }}</p>
        @php
            $start = Carbon::parse($createdAt);
            $difference = $start->diffInMinutes(Carbon::now());
        @endphp
        @auth
        <span role="button" class="reply" id="{{ $id }}"
            style="font-size: 14px;color: #4a5661;">Reply</span>
        <span role="button" class="editcmnt mx-1 {{ $difference > 30 ? 'd-none' : '' }}" id="{{ $id }}"
            style="font-size: 14px;color: #4a5661;">Edit</span>
        <span role="button" class="dltcmnt {{ $difference > 30 ? 'd-none' : '' }}" id="{{ $id }}"
            style="font-size: 14px;color: #4a5661;">Delete</span>

        @endauth
        <div class="replyform d-none" id="replyform_{{$id}}" data-id="{{$id}}">
            <div class="input-group mb-3">
                <input type="text" id="replydescription_{{$id}}" class="form-control replydescription" placeholder="Write your Reply here..."
                    aria-label="replycmnt" aria-describedby="replycmnt" data-id={{$id}}>
                <button class="btn btn-secondary" type="button" id="replycmnt" data-val="{{$postid}}" data-id="{{$id}}"><i
                        class="fa fa-paper-plane" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </div>


</div>
