<x-frontend.master>
    <x-frontend.header image="{{ asset('assets/images/banner1.jpg') }}" title="JustBlogged"
        subtitle="A Blog Website by Mansi" posttitle="" />
    <div class="row px-3 my-3">
        <div class="col-md-12 my-2">
            <h1 style="text-align: center;color: #4a5661;"><i>Top Categories</i></h1>
        </div>
        <hr>
        @forelse ($topcategories as $topcat)
            <div class="col-md-4">
                <x-frontend.category-card image="{{ asset('storage/' . $topcat->image) }}" name="{{ $topcat->name }}"
                    slug="{{ $topcat->slug }}" />
            </div>
        @empty
            <div class="col-md-12 p-3 m-3">
                <h2 style="text-align: center;color: #4a5661;">No Category to show!!</h2>
            </div>
        @endforelse
    </div>
    <div class="row px-3 my-3">
        <div class="col-md-12 mt-3">
            <h1 style="text-align: center;color: #4a5661;"><i>All Posts</i></h1>
            <hr>
        </div>
        @forelse ($posts as $post)
            <div class="col-md-4">
                <x-frontend.post-card image="{{ asset('storage/' . $post->image) }}" title="{{ $post->title }}"
                    description="{{ $post->description }}" author="{{ $post->user->name }}" time="{{ $post->created_at->diffForHumans() }}" :categories="$post->categories" userimage="{{asset('storage/'.$post->user->image)}}" slug="{{$post->slug}}" />
            </div>
        @empty
            <div class="col-md-12 p-3 m-3">
                <h2 style="text-align: center;color: #4a5661;">No Post to show!!</h2>
            </div>
        @endforelse
            {{ $posts->links() }}

    </div>
</x-frontend.master>
