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
            <li>Show Role</li>
        </ul>
    </div>

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Show Role</h3>
                        <a class="btn btn-primary btn-lg" href="{{ route('roles.index') }}">Back</a>
                    </div>



                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                {{ $role->name }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Permissions:</strong>
                                @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                <label class="label label-success"><span class="p-1 fs-3 rounded text-white bg-info">{{ $v->name }}</span></label>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>



            <!--  End Here -->
            <footer class="footer-wrap-layout1">
                <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
            </footer>
        </div>
        @endsection