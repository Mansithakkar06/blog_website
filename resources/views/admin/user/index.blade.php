<x-admin.master>
    <x-admin.page-title title="User" />
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary openModal" data-toggle="modal" data-title="Add User"
        data-url="{{ route('user.create') }}" data-type="POST">
        ADD
    </button>
    <br>
    <br>
    <table class="table table-bordered" id="usertable">
        <thead class="thead-light">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (count($users) != 0)
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td><img src="{{ $user->image != null ? asset('storage/' . $user->image) : asset('assets/images/profile.jpg') }}"
                                alt="image" height="50" width="50"></td>
                        <td>{{ $user->status }}</td>
                        <td><a href="#" type="button" class="btn btn-success btn-sm editbtn openModal"
                                data-toggle="modal" data-title="Edit User"
                                data-url="{{ route('user.edit', $user->id) }}" data-type="GET"
                                data-id={{ $user->id }}>Edit</a> <a href="#" type="button"
                                class="btn btn-danger btn-sm deletebtn" data-id="{{ $user->id }}">Delete</a></td>
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
            $('#exampleModal').on("submit", "#addUserForm", function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                let formData = new FormData();
                formData.append("name", $("#name").val());
                formData.append("email", $("#email").val());
                formData.append("phone", $("#phone").val());
                formData.append("password", $("#password").val());
                let photo = $('#image').prop('files')[0];
                if (photo != undefined) {
                    formData.append('image', photo);
                }
                // formData.append("image",$("#image").val());
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
                        $("#usertable").load(location.href + " #usertable");
                    },
                     error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $('#' + field).after(`<div class="text-danger">${messages[0]}</div>`);
                        });
                    }
                });
            });
            $(document).on("click", ".deletebtn", function() {
                let id = $(this).data("id");
                let url = "{{ route('user.delete', '/id') }}";
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
                                $("#usertable").load(location.href + " #usertable");
                            },
                            error:function(res){
                                toastr.error(res);
                            }
                        })
                    }
                });
            })
            $('#exampleModal').on("submit", "#updateUserForm", function(e) {
                e.preventDefault();
                let url = $(this).data("url");
                let data = new FormData();
                data.append("_method", 'PUT');
                data.append("id", $("#updateUserForm #id").val());
                data.append("name", $("#updateUserForm #name").val());
                data.append("email", $("#updateUserForm #email").val());
                data.append("phone", $("#updateUserForm #phone").val());
                data.append("password", $("#updateUserForm #password").val());
                var photo = $('#updateUserForm #image').prop('files')[0];
                if (photo != undefined) {
                    data.append('image', photo);
                }
                data.append("status", $("#updateUserForm #status").val());
                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    contentType: 'multipart/form-data',
                    cache: false,
                    contentType: false,
                    processData: false,

                    success: function(res) {
                        $("#exampleModal").modal("hide");
                        toastr.success(res);
                        $("#usertable").load(location.href + " #usertable");

                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            $('#' + field).after(`<div class="text-danger">${messages[0]}</div>`);
                        });
                    }
                });
            });
        </script>
    @endpush
</x-admin.master>
