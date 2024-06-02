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
            <li>Role Management</li>
        </ul>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($message = Session::get('failure'))
    <div class="alert alert-dismissible alert-danger">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">

                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>Create New Role</h3>

                        <a class="btn btn-primary btn-lg" href="{{ route('roles.index') }}">Back</a>
                    </div>

                    <form method="POST" action="{{route('roles.store')}}" class="new-added-form">
                        @csrf
                        <div class="row gutters-20">
                            <div class="col-xl-12 col-lg-6 col-12 form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>

                            <div class="col-xl-12">
                                <label>Permission</label><br>
                            </div>
                            @foreach($permissioncategory as $value)
                            <div class="col-lg-3 my-4 text-white col-12 form-group bg-info p-3 rounded">
                                <div class="box-style">
                                    <h5>{{$value->name}}</h5>
                                    @foreach($value->permission as $data)
                                    <label>
                                        <input type="checkbox" name="permission[]" value="{{$data->id}}">&nbsp;&nbsp;{{$data->name}}
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


            <!-- End Here -->
            <footer class="footer-wrap-layout1">
                <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
            </footer>
        </div>
        @endsection
