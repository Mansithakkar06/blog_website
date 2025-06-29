<form action="" data-url={{ route('category.update',$category->id) }} id="updateCategoryForm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 mb-2">
            <input type="hidden" name="id" id="id" value="{{ $category->id }}">
            <label for="name">Name</label><span class="text-danger">*</span>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>
         <div class="col-md-12 mb-2">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" value="{{ $category->image }}" class="form-control">
        </div>
         <div class="col-md-12 mb-2">
            <label for="status">Status</label><span class="text-danger">*</span>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="active" {{ $category->status=='active'?'selected':'' }}>Active</option>
                <option value="inactive"  {{ $category->status=='inactive'?'selected':'' }}>Inactive</option>
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </div>
</form>
