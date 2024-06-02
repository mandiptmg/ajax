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
            <li>Product section</li>
        </ul>
    </div>

    <!-- Add New product Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Add Product</h3>
                @can('create portfolio')

                <a class="btn btn-primary btn-lg" href="{{ route('products.create') }}">add product</a>
                @endcan
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!--Product table data  -->

            <div class="table-responsive mt-5">
                <table class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                    <label class="form-check-label">ID</label>
                                </div>
                            </th>

                            <th>Title</th>

                            <th>Actions</th>

                        </tr>

                    </thead>
                    <tbody id="productId" class="">
                        @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->title }}</td>
                            <td class="d-flex flex-row">

                                <div class="mx-2">

                                    @can('view product')
                                    <a href="{{ url('/admin/products' , $product->id)}}" class="fw-btn-fill btn-info ">
                                        view
                                    </a>
                                    @endcan

                                </div>
                                <div class="mx-2">
                                    @can('update product')
                                    <a href="{{ url('admin/products/edit/' . $product->id)}}" class="fw-btn-fill btn-primary ">
                                        update
                                    </a>
                                    @endcan

                                </div>

                                <div class="mx-2">
                                    @can('delete product')
                                    <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ $product->id}}')" class="btn fw-btn-fill btn-danger">Delete</button>
                                    @endcan
                                </div>


                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


    </div>
    <!-- Add New product Area End Here -->

    <!-- Delete Modal -->
    <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Product</h3>
                </div>
                <div class="modal-body">
                    <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <input type="hidden" id="product_id" name="product_id">
                            <div class="">
                                Are you Sure? You want to delete this Product.
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Delete</button>
                                <button type="button" class="btn bg-danger btn-fill-lg" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Modal -->


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
        var address = "{{url('admin/products/delete/')}}" + '/' + id;
        form.prop('action', address);
    }
    // Delete form submission
    $('#deleteform').submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.attr('action'), 
            type: form.prop('method'),
            data: form.serialize(),
            success: function(response) {
                // Handle success response
                console.log(response);
                $.get(window.location.href, function(data) {
                    var newTbody = $(data).find('.table-responsive #productId').html();
                    $('.table-responsive #productId').html(newTbody);
                });
                $('#destroyModal').modal('hide');
                // You can perform actions like hiding modal, refreshing the product list, etc.
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    });
</script>

@endsection