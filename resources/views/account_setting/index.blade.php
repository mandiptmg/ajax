@extends('layouts.adminmaster')
@section('content')

<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Account Setting</h3>
        <ul>
            <li>
                <a href="{{url('/admin')}}">Home</a>
            </li>
            <li>Setting</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Account Settings Area Start Here -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Add New User</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <form class="new-added-form">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>First Name *</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Last Name *</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>User Type *</label>
                                <select class="select2">
                                    <option value="">Please Select*</option>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                </select>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Gender *</label>
                                <select class="select2">
                                    <option value="">Please Select Gender *</option>
                                    <option value="1">Male</option>
                                    <option value="2">Female</option>
                                    <option value="3">Others</option>
                                </select>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>E-Mail</label>
                                <input type="email" placeholder="" class="form-control">
                            </div>

                            <div class="col-xl-3 col-lg-6 col-12 form-group">
                                <label>Phone</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>

                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4-xxxl col-xl-5">
            <div class="card account-settings-box height-auto">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-20">
                        <div class="item-title">
                            <h3>All User</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>

                    <!-- user box -->
                    <div class="all-user-box">
                        <div class="media media-none--xs active">
                            <div class="item-img">
                                <img src="img/figure/user1.jpg" class="media-img-auto" alt="user">
                            </div>
                            <div class="media-body space-md">
                                <h5 class="item-title">Steven Johnson</h5>
                                <div class="item-subtitle">Super Admin</div>
                            </div>
                        </div>
                        <div class="media media-none--xs">
                            <div class="item-img">
                                <img src="img/figure/user2.jpg" class="media-img-auto" alt="user">
                            </div>
                            <div class="media-body space-md">
                                <h5 class="item-title">Maria Jane</h5>
                                <div class="item-subtitle">Super Admin</div>
                            </div>
                        </div>
                        <div class="media media-none--xs">
                            <div class="item-img">
                                <img src="img/figure/user3.jpg" class="media-img-auto" alt="user">
                            </div>
                            <div class="media-body space-md">
                                <h5 class="item-title">Andrew Walles</h5>
                                <div class="item-subtitle">Super Admin</div>
                            </div>
                        </div>
                        <div class="media media-none--xs">
                            <div class="item-img">
                                <img src="img/figure/user4.jpg" class="media-img-auto" alt="user">
                            </div>
                            <div class="media-body space-md">
                                <h5 class="item-title">Walter Emma</h5>
                                <div class="item-subtitle">Super Admin</div>
                            </div>
                        </div>
                        <div class="media media-none--xs">
                            <div class="item-img">
                                <img src="img/figure/user5.jpg" class="media-img-auto" alt="user">
                            </div>
                            <div class="media-body space-md">
                                <h5 class="item-title">Stuart Johnson</h5>
                                <div class="item-subtitle">Super Admin</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-8-xxxl col-xl-7">
            <div class="card account-settings-box">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-20">
                        <div class="item-title">
                            <h3>User Details</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="user-details-box">
                        <div class="item-img">
                            <img src="img/figure/user.jpg" alt="user">
                        </div>
                        <div class="item-content">
                            <div class="info-table table-responsive">
                                <table class="table text-nowrap">
                                    <tbody>
                                        <tr>
                                            <td>Name:</td>
                                            <td class="font-medium text-dark-medium">Steven Johnson</td>
                                        </tr>
                                        <tr>
                                            <td>User Type:</td>
                                            <td class="font-medium text-dark-medium">Super Admin</td>
                                        </tr>
                                        <tr>
                                            <td>Gender:</td>
                                            <td class="font-medium text-dark-medium">Male</td>
                                        </tr>


                                        <tr>
                                            <td>E-mail:</td>
                                            <td class="font-medium text-dark-medium">stevenjohnson@gmail.com</td>
                                        </tr>

                                        <tr>
                                            <td>Phone:</td>
                                            <td class="font-medium text-dark-medium">+ 88 98568888418</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Account Settings Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
    </footer>
</div>


@endsection