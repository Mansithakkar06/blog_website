<div class="row px-2">
    <div class="col-md-12"><span class="m-2 badge {{ $post->status == 'published' ? 'text-bg-success' : ($post->status == 'draft' ? 'text-bg-warning' : 'text-bg-danger') }}" style="float: right;">{{ $post->status }}</span></div>
    <div class="col-md-12 d-flex">
        <img src="{{ asset('storage/'.$post->image) }}" class="m-auto" alt="" height="250px" width="100%">
    </div>
    <div class="col-md-12 py-3 short-text"><p>{{ mb_strimwidth($post->description,0,350,".......") }}<span role="button" class="readmore" style="font-weight:bold;font-size: 18px;">read more</span></p></div>
    <div class="col-md-12 py-3 full-text d-none"><p>{{ $post->description }}</p></div>
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
