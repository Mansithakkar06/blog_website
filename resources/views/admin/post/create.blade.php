<x-admin.master>
    <x-admin.page-title title="Add Post" />
    <div class="card">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col">
                        <label for="title">Title</label><span class="text-danger">*</span>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="slug">Slug</label><span class="text-danger">*</span>
                        <input type="text" name="slug" id="slug" class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="description">Description</label><span class="text-danger">*</span>
                        <textarea name="description" id="description" cols="10" rows="7" class="form-control" required></textarea>
                    </div>
                </div>
                 <div class="row mt-3">
                    <div class="col">
                        <label for="category_id">Category</label><span class="text-danger">*</span>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="image">Image</label><span class="text-danger">*</span>
                        <input type="file" name="image" id="image" class="form-control" required>
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
                    </div>
                    <div class="col">
                        <label for="user_id">User</label><span class="text-danger">*</span>
                        <select name="user_id" id="user_id" class="form-control" required>
                            <option value="">Select User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
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
