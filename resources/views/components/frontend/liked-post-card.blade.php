<div class="card my-3 me-2 shadow bg-body rounded p-1">
   <div class="card-body">
    <img src="{{$image}}" alt="post image" height="250px" width="100%">
    <a href="{{route('frontend.post',["post"=>$slug])}}"><h5 class="mt-2 py-1" style="color: #4a5661;">{!!$title!!}</h5></a>
   </div>
</div>
