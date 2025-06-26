<x-admin.master>
    <x-admin.page-title title="Add Post" />
    <div class="card">
        <div class="card-body">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="title">Title</label><span class="text-danger">*</span>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="form-control" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="category_id">Category</label><span class="text-danger">*</span>
                        <select name="category_id[]" id="category_id" class="form-control select2" multiple required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="description">Description</label><span class="text-danger">*</span>
                        <textarea name="description" id="description" cols="10" rows="7" class="form-control" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label><span class="text-danger">*</span>
                        <input type="file" name="image" id="image" value="{{ old('iamge') }}"
                            class="form-control" required>
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="status">Status</label><span class="text-danger">*</span>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="unpublished">Unpublished</option>
                        </select>
                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row mt-3">
                    <div class="col">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-admin.master>
