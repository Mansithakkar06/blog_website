<x-frontend.master>
      <x-frontend.header image="{{ asset('storage/' . $category->image) }}" title="{{$category->name}}" subtitle="" />
       <div class="row px-3">
         @forelse ($posts as $post)
         <div class="col-md-4">
                <x-frontend.post-card image="{{ asset('storage/' . $post->image) }}" title="{{ $post->title }}"
                    description="{{ $post->description }}" author="{{ $post->user->name }}" time="{{ $post->created_at->diffForHumans() }}" :categories="$post->categories" userimage="{{asset('storage/'.$post->user->image)}}" slug="{{$post->slug}}" />
            </div>
        @empty
            <div class="col-md-12 p-3 m-3"><h2 style="text-align: center;color: #4a5661;">No Post to show!!</h2></div>
        @endforelse
    </div>
</x-frontend.master>
