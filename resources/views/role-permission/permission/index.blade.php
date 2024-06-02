@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Creation Soft Nepal</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Services section</li>
        </ul>
    </div>

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div id="result"></div>
                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>Permission</h3>
                        </div>
                        <!-- Button trigger modal -->
                        <div>
                            @can('create permission')
                            <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                                Add permission
                            </button>
                            @endcan
                        </div>
                    </div>





                </div>


                <!-- data tabel  -->
                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">ID</label>
                                    </div>
                                </th>
                                <th>Permission Name</th>
                                <th>permission category</th>

                                <th>Action</th>

                            </tr>


                        </thead>
                        <tbody id="serviceId">
                            @foreach ($permissions as $key=>$permission)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $permission->name }}</td>
                                <td> <span class="badge text-white bg-primary">{{ $permission->permissioncategory->name }} </span> </td>


                                <td>
                                    <div class="d-flex flex-row gap-4 font-semibold">
                                        <div class="px-1">
                                            @can('update permission')
                                            <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($permission->id) }}', '{{ addslashes($permission->name) }}', '{{ addslashes($permission->permissioncategory_id) }}')" data-toggle="modal" data-target="#editModal">
                                                Edit
                                            </button>
                                            @endcan

                                        </div>
                                        <div>
                                            @can('delete permission')
                                            <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($permission->id) }}')" class="btn btn-danger btn-lg">Delete</button>
                                            @endcan
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{ $permissions->links() }}
                </div>
                <!-- data table end  -->
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-top">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Add Permission</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class=" col-12 col-lg-6 form-group">
                                        <label>Permission Name</label>
                                        <input type="text" class="form-control" id="name" required name="name">
                                        <div id="permissionError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label for="permissioncategory_id">Permission Category:</label>
                                        <select id="permissioncategory_id" class="form-control" name="permissioncategory_id" required>
                                            <option value="">Select permission categories</option>
                                            @foreach ($permissionCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save permission</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <!--Edit Modal -->

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog  modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-permission fs-5" id="exampleModalLabel">Edit Permission</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="editform" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row d-flex justify-content-between">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Permission Name</label>
                                        <input type="hidden" id="permission_id" name="permission_id">
                                        <input type="text" id="permission_name" value="{{('$permission->name')}}" class="form-control" name="name" required>
                                        <div id="permissionError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Permission Category:</label>
                                        <select id="permissioncat_id" name="permissioncategory_id" class="form-control" required>
                                            <option value="">Select permission categories</option>

                                            @foreach ($permissionCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>


            <!--Destroy Modal -->

            <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-permission fs-5" id="exampleModalLabel">Delete Service</h3>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <div class=" form-group">

                                    <input type="hidden" id="permission_id" name="permission_id">
                                    <div class="">
                                        Are you Sure ? You want to delete this Service.
                                    </div>
                                    <div class=" form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Delete</button>
                                        <button type="submit" data-dismiss="modal" aria-label="Close" class="btn bg-danger btn-fill-lg ">Cancel</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>

            <!--Destroy Modal end-->
        </div>

        <footer class="footer-wrap-layout1">
            <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
        </footer>
    </div>
    @endsection

    @section('scripts')

    <script>
        function destroy(id) {
            console.log(id);
            var form = $('#deleteform');
            var address = "{{url('admin/permissions/delete/')}}" + '/' + id;
            form.prop('action', address);
        }

        function edit(id, name, permissioncategory_id) {
            $('#permission_name').val(name);
            $('#permission_id').val(id);
            $('#permissioncat_id').val(permissioncategory_id);
            console.log(permissioncategory_id)


        }
        $(document).ready(function() {
            $('#editform').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object
                var permissionId = formData.get('permission_id');
                $.ajax({
                    url: "{{ url('admin/permissions') }}" + '/' + permissionId,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {

                            $('#permissionError').html('');


                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {
                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success');
                            $.get(window.location.href, function(data) {
                                var newTbody = $(data).find('.table-responsive #serviceId').html();
                                $('.table-responsive #serviceId').html(newTbody);
                            });
                            $('#editModal').modal('hide');

                        }
                    }

                });
            });
        });


        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object
                $.ajax({
                    url: "{{ route('permissions.store') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {
                            $('#permissionError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {

                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success')
                            $('form')[0].reset();
                            // Reload the page if $services exists
                            $.get(window.location.href, function(data) {
                                var newTbody = $(data).find('.table-responsive #serviceId').html();
                                $('.table-responsive #serviceId').html(newTbody);
                            });
                            $('#exampleModal').modal('hide');

                        }
                    }

                });
            });
        });
    </script>
    @endsection