@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Creation Soft Nepal</h3>
        <ul>
            <li>
                <a href="{{url('/admin')}}">Home</a>
            </li>
            <li>Users</li>
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
                            <h3>All Users</h3>
                        </div>
                        <!-- Button trigger modal -->
                        <div>
                            @can('create user')
                            <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                                Add User
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Actions</th>
                            </tr>


                        </thead>
                        <tbody id="serviceId">
                            @foreach ($users as $key=>$user)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>

                                    @forelse ($user->getRoleNames() as $role)
                                    <span class="badge text-white bg-primary">{{ $role }}</span>
                                    @empty
                                    @endforelse
                                </td>

                                <td>
                                    <div class="d-flex flex-row gap-4 font-semibold">
                                        <div class="px-1">
                                            @can('update user')
                                            <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($user->id) }}', '{{ addslashes($user->name) }}','{{ addslashes($user->email) }}','{{ implode(', ', $user->getRoleNames()->toArray()) }}')
" data-toggle="modal" data-target="#editModal">
                                                Edit
                                            </button>
                                            @endcan

                                        </div>
                                        <div>
                                            @can('delete permission category')

                                            <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($user->id) }}')" class="btn btn-danger btn-lg">Delete</button>

                                            @endcan
                                        </div>
                                    </div>

                                </td>

                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title fs-5" id="exampleModalLabel">Add User</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                                    <div id="userNameError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" placeholder="Enter email" class="form-control">
                                    <div id="userEmailError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" placeholder="Enter password" class="form-control">
                                    <div id="userPasswordError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password" placeholder="Confirm password" name="password_confirmation" class="form-control">
                                    <div id="userPasswordError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="roles">Roles</label>
                                    <select class="form-control" aria-label="Roles" id="roles" name="roles[]">
                                    <option value="">Select Role</option>
                                @forelse ($roles as $role)

                                    @if ($role!='super-admin')
                                        <option value="{{ $role }}">
                                        {{ $role }}
                                        </option>
                                    @else
                                        @if (Auth::user()->hasRole('super-admin'))   
                                            <option value="{{ $role }}">
                                            {{ $role }}
                                            </option>
                                        @endif
                                    @endif

                                @empty

                                @endforelse
                            </select>
                                    <div id="userRoleError"></div>
                                </div>
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!--Edit Modal -->

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-permission fs-5" id="exampleModalLabel">Edit Permission category</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="new-added-form" id="editform" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="row">
                                <input type="hidden" id="user_id" name="user_id">

                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="name">Name</label>
                                    <input type="text" id="user_name" placeholder="Enter full name" name="name" class="form-control" required>
                                    <div id="userNameError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="user_email" placeholder="Email address" class="form-control" required>
                                    <div id="userEmailError"></div>
                                </div>
                                <div class=" col-lg-6 col-12 form-group">
                                    <label for="roles">Roles</label>
                                    <select name="roles[]" id="user_roles" class="form-control" required>
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    <div id="userRoleError"></div>
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

        <!-- Add New Teacher Area End Here -->
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
            var address = "{{url('admin/users/delete/')}}" + '/' + id;
            form.prop('action', address);
        }

        function edit(id, name, email, roles) {
            $('#user_name').val(name);
            $('#user_id').val(id);
            $('#user_email').val(email);
            $('#user_roles').val(roles);
            console.log(roles)

        }
        $(document).ready(function() {
            $('#editform').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object
                var userId = formData.get('user_id');
                $.ajax({
                    url: "{{ url('admin/users') }}" + '/' + userId,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {

                            $('#userNameError').html('');
                            $('#userEmailError').html('');
                            $('#userPasswordError').html('');
                            $('#userRolesError').html('');


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
                    url: "{{ route('users.store') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {
                            $('#userNameError').html('');
                            $('#userEmailError').html('');
                            $('#userPasswordError').html('');
                            $('#userRolesError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {

                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success')
                            $('#myForm').trigger('reset')
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