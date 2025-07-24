<x-admin.master>
    <x-admin.page-title title="Edit Post" />
     <div class="card">
        <div class="card-body">
            <form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="id" id="id" value="{{$post->id}}">
                        <label for="title">Title</label><span class="text-danger">*</span>
                        <input type="text" name="title" id="title" value="{{$post->title}}" class="form-control" required>
                    </div>
                    <div class="col">
                       <label for="category_id">Category</label><span class="text-danger">*</span>
                        <select name="category_id[]" id="category_id" class="form-control select2" multiple required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ in_array($category->id,$post->categories->pluck('id')->toArray()) ? "selected" : ""}} >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="description">Description</label><span class="text-danger">*</span>
                        <textarea name="description" id="description" cols="10" rows="7" class="form-control" required>{{$post->description}}</textarea>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label><span class="text-danger">*</span>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="status">Status</label><span class="text-danger">*</span>
                        <select name="status" id="status" class="form-control" required>
                            <option value="draft" {{$post->status=='draft'?'selected':''}}>Draft</option>
                            <option value="published" {{$post->status=='published'?'selected':'' }}>Published</option>
                            <option value="unpublished" {{$post->status=='unpublished'?'selected':''}}>Unpublished</option>
                        </select>
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin.master>
