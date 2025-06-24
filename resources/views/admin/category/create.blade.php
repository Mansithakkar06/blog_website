<form action="" data-url={{ route('category.store') }} id="addCategoryForm" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-12 mb-2">
            <label for="name">Name</label><span class="text-danger">*</span>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
         <div class="col-md-12 mb-2">
            <label for="slug">Slug</label><span class="text-danger">*</span>
            <input type="text" name="slug" id="slug" class="form-control" required>
        </div>
         <div class="col-md-12 mb-2">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
         <div class="col-md-12 mb-2">
            <label for="status">Status</label><span class="text-danger">*</span>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>
