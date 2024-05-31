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
                        <h3>Edit Role/Permission Assigned</h3>

                        <a class="btn btn-primary btn-lg" href="{{ route('roles.index') }}">Back</a>
                    </div>
                    <form method="POST" action="{{url('admin/roles/'.$role->id)}}" class="new-added-form">
                        @csrf
                        {{method_field('PATCH')}}
                        <div class="row gutters-20">
                            <div class="col-xl-12 col-lg-6 col-12 form-group">
                                <label>Name *</label>
                                <input type="text" name="name" value="{{ $role->name }}" placeholder="Name" class="form-control">
                            </div>

                            <div class="col-xl-12">
                                <label>Permission</label><br>
                            </div>
                            @foreach($permissioncategory as $value)
                            <div class="col-xl-3 col-lg-12 col-12 form-group">
                                <div class="box-style">
                                    <h5>{{$value->name}}</h5>
                                    @foreach($value->permission as $data)

                                    <label>
                                        <input type="checkbox" name="permission[]" value="{{ $data->id }}" {{ in_array($data->id, $rolePermissions) ? 'checked' : '' }} class="name"> {{ $data->name }}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>



            <!--  End Here -->
            <footer class="footer-wrap-layout1">
                <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
            </footer>
        </div>
        @endsection