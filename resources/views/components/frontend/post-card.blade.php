<div class="card mx-2 my-3 p-1 shadow bg-body rounded" style="height: 95%;">
    <div class="card-body">
        <div class="post-image">
           <a href="{{route('frontend.post',["post"=>$slug])}}"> <img src="{{$image}}" alt="Post image" height="230px" width="100%"></a>
        </div>
        <div class="author d-flex justify-content-between mt-2">
            <span style="font-size: 18px;"> <img src="{{$userimage}}" width="25" height="25" class="rounded-circle" alt="user image"> <i style="color: #4a5661;">{{$author}}</i></span> <span style="font-size: 18px;"> {{$time}}</span>
        </div>
        <div class="title">
           <a href="{{route('frontend.post',["post"=>$slug])}}"><h5 class="mt-2" style="color: #4a5661;">{!!$title!!}</h5></a>
           <p class="mt-2" style="font-size: 18px;">{!! strlen($title)>60 ? mb_strimwidth($description,0,110,".......") : mb_strimwidth($description,0,165,".......") !!}<span><a href="{{route('frontend.post',["post"=>$slug])}}" style="font-weight:bold;font-size: 18px;">Continue reading</a></span></p>
        </div>
        <div class="categories">
            @foreach ($categories as $category)
                <a href="{{route('frontend.category',['category'=>$category->slug])}}"><span class="badge rounded-pill text-bg-success">{{$category->name}}</span></a>
            @endforeach
        </div>
    </div>
</div>
