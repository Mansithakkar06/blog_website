<div class="row p-3">
    <div class="col-md-12"><span class="badge {{ $post->status == 'published' ? 'text-bg-success' : ($post->status == 'draft' ? 'text-bg-warning' : 'text-bg-danger') }}" style="float: right;">{{ $post->status }}</span></div>
    <div class="col-md-12 d-flex">
        <img src="{{ asset('storage/'.$post->image) }}" class="m-auto" alt="" height="200px" width="300px">
    </div>
    <div class="col-md-12"><p>{{$post->description}}</p></div>
    <div class="col-md-6">
        <h5>Category</h5>
        @foreach ($post->categories as $category)
            <span>{{$category->name}}, </span>
        @endforeach
    </div>
    <div class="col-md-6">
        <h5>Created By:</h5>
    <p>{{$post->user->name}} ({{$post->created_at->diffForHumans()}})</p>
    </div>
</div>
