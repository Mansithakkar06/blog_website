<x-admin.master>
    <x-admin.page-title title="Category" />
    <button class="btn btn-primary openModal" data-toggle="modal" data-title="Add Category"
        data-url="{{ route('category.create') }}" data-type="GET">ADD</button>
    <br>
    <br>
    <table class="table table-bordered" id="cattable">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">slug</th>
                <th scope="col">image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($categories) != 0)
                @foreach ($categories as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td><img src="{{ $category->image != null ? asset('storage/' . $category->image) : asset('assets/images/profile.jpg') }}"
                                height="50px" width="50px" alt="image"> </td>
                        <td><span class="badge {{ $category->status=="active"?'text-bg-success':'text-bg-danger' }} ">{{ $category->status }}</span></td>
                        <td><a href="#" type="button" class="btn btn-success btn-sm openModal"
                                data-url="{{ route('category.edit', $category->id) }}"
                                data-title="Edit Category"><i class="fas fa-edit"></i></a> <a href="#" data-id="{{ $category->id }}"
                                class="btn btn-danger btn-sm dltbtn"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center;">No Record Found!!</td>
                </tr>
            @endif

        </tbody>
    </table>
    @push('script')
        <script>
            $(document).on("submit", "#addCategoryForm", function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                let formData = new FormData();
                formData.append("name", $("#name").val());
                formData.append("slug", $("#slug").val());
                let photo = $("#image").prop('files')[0];
                if (photo != undefined) {
                    formData.append("image", photo);
                }
                formData.append("status", $("#status").val());
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $("#exampleModal").modal("hide");
                        toastr.success(res);
                        // $("#cattable").load(location.href + " #cattable");
                            setTimeout(() => {
                            window.location.reload();
                        }, 500);

                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $("#" + field).after(`<div class='text-danger'>${messages[0]}</div>`);
                        })
                    }
                })

            });
            $(document).on("submit", "#updateCategoryForm", function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                let formData = new FormData();
                formData.append("_method", "PUT");
                formData.append("id", $("#id").val());
                formData.append("name", $("#name").val());
                formData.append("slug", $("#slug").val());
                let photo = $("#image").prop('files')[0];
                if (photo != undefined) {
                    formData.append("image", photo);
                }
                formData.append("status", $("#status").val());
                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    contentType: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        $("#exampleModal").modal("hide");
                        toastr.success(res);
                        // $("#cattable").load(location.href + " #cattable");
                            setTimeout(() => {
                            window.location.reload();
                        }, 500);

                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $("#" + field).after(`<div class="text-danger">${messages[0]}</div>`);
                        })
                    }
                })

            })
            $(document).on("click", ".dltbtn", function() {
                let id = $(this).data("id");
                let url = "{{ route('category.destroy', '/id') }}";
                url = url.replace('/id', id);
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            success: function(res) {
                                toastr.success(res);
                                // $("#cattable").load(location.href + " #cattable");
                                    setTimeout(() => {
                            window.location.reload();
                        }, 500);
                            },
                            error: function(res) {
                                toastr.error(res);
                            }
                        })
                    }
                })
            })
        </script>
    @endpush
</x-admin.master>
