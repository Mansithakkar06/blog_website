<div class="card shadow bg-body rounded">
    <a href="{{route('frontend.category',['category'=>$slug])}}">
    <div class="card-body">
        <img src="{{ $image }}" alt="category image" height="250px" width="100%">
        <span class="badge text-bg-success" style=" position: absolute;top: 30px;
  right: 30px;">{{$name}}</span>
    </div>
    </a>
</div>
