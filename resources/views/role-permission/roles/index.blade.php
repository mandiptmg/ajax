@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Creation Soft Nepal</h3>
        <ul>
            <li>

                <a href="{{url('admin/dashboard')}}">Home</a>

            </li>
            <li>Role Management</li>
        </ul>
    </div>

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
                @endif
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Roles</h3>
                        <a class="btn btn-primary btn-lg" href="{{ route('roles.create') }}">Add Role</a>
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
                                    <th>role Name</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            <tbody id="serviceId">
                                @foreach ($roles as $key=>$role)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $role->name }}</td>

                                    <td>
                                        <div class="d-flex flex-row gap-4 font-semibold">
                                            <div class="px-1">

                                                <a class="btn btn-info btn-lg" href="{{ route('roles.show', $role->id) }}">Show</a>
                                                <a class="btn btn-primary btn-lg" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                            </div>
                                            <div>
                                                <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($role->id) }}')" class="btn btn-danger btn-lg">Delete</button>
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


            <!--Destroy Modal -->

            <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-role fs-5" id="exampleModalLabel">Delete Service</h3>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <div class=" form-group">

                                    <input type="hidden" id="role_id" name="role_id">
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
                var address = "{{url('admin/roles/delete/')}}" + '/' + id;
                form.prop('action', address);
            }
        </script>
        @endsection