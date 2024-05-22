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
            <li>Product section</li>
        </ul>
    </div>

    <!-- Add New product Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div>
                <div>
                    <h3>Add Product</h3>
                </div>

            </div>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div>
                <form class="new-added-form" id="myProductForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 col-12 form-group">
                            <label>Top background Photo</label>
                            <input type="file" class="form-control-file" id="bg_image1" name="bg_image1">
                            <div id="bg_image1Error"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Title</label>
                            <input type="text" placeholder="Title" id="title" value="{{old('title')}}" class="form-control" name="title">
                            <div id="titleError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Short Description</label>
                            <textarea rows="9" cols="10" type="text" placeholder="Short Description..." id='short_description' class="form-control" name="short_description">{{old('short_description')}}</textarea>
                            <div id="short_descriptionError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Description</label>
                            <textarea rows="9" cols="10" type="text" placeholder="Description..." id='description' class="form-control" name="description">{{old('description')}}</textarea>
                            <div id="descriptionError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>product Image</label>
                            <input type="file" class="form-control-file" value="{{old('image')}}" id="image" multiple name="image[]">
                            <div id="imageError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Middle background Photo</label>
                            <input type="file" class="form-control-file" value="{{old('bg_image2')}}" id="logo" name="bg_image2">
                            <div id="bg_image2Error"></div>
                        </div>
                        <!-- add feature -->
                        <div class="col-12 form-group">
                            <label>Add features</label>
                            <div class="w-100 border">

                                <button type="button" id="add-feature" class="w-100">Add Feature</button>
                            </div>
                            <div id="features-container">
                                <!-- Dynamic fields will be added here -->
                            </div>

                        </div>
                        <!-- add benefit  -->
                        <div class="col-12 form-group">
                            <label>Add Benefits</label>
                            <div class="w-100 border">

                                <button type="button" id="add-benefit" class="w-100">Add Benefit</button>
                            </div>
                            <div id="benefits-container">
                                <!-- Dynamic fields will be added here -->
                            </div>

                        </div>
                        <!-- add Question and answer  -->
                        <div class="col-12 form-group">
                            <label>Add Question and Answer</label>
                            <div class="w-100 border">

                                <button type="button" id="add-question" class="w-100">Add Question and Answer</button>
                            </div>
                            <div id="questions-container">
                                <!-- Dynamic fields will be added here -->
                            </div>

                        </div>


                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        </div>
                    </div>

                </form>
            </div>
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
                                    <a href="{{ url('/admin/products' , $product->id)}}" class="fw-btn-fill btn-gradient-yellow ">
                                        view
                                    </a>

                                </div>
                                <div class="mx-2">

                                    <a href="{{ url('/admin/products/edit' , $product->id)}}" class="fw-btn-fill btn-gradient-yellow ">
                                        update
                                    </a>


                                </div>

                                <div class="mx-2">

                                    <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ $product->id}}')" class="btn fw-btn-fill btn-danger">Delete</button>
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
    // Product delete
    function destroy(id) {
        var form = $('#deleteform');
        var address = "{{ url('admin/products/delete') }}" + '/' + id;
        form.prop('action', address);
    }

    // Delete form submission
    $('#deleteform').submit(function(e) {
        e.preventDefault();
        var form = $(this);

        $.ajax({
            url: form.prop('action'),
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


    // Add feature
    $('#add-feature').click(function() {
        const featureTemplate = `
                <div class="feature row pt-3">
                    <div class="col-lg-3 col-12">
                        <input type="file" name="logo[]" accept="image/*" class='form-control' required>
                    </div>
                    <div class="col-lg-3 col-12">
                        <input type="text" name="title_feature[]" class='form-control' placeholder="Title" required>
                    </div>
                    <div class="col-lg-4 col-12">
                        <textarea name="description_feature[]" class='form-control' placeholder="Description" rows="1" required></textarea>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-primary btn-lg edit-feature ">edit</button>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-danger btn-lg remove-feature">Remove</button>
                    </div>
                </div>`;
        $('#features-container').append(featureTemplate);
    });

    //Add Benefit
    $('#add-benefit').click(function() {
        const benefitTemplate = `
                <div class="benefit row pt-3">
                   
                    <div class="col-lg-10 col-12">
                        <textarea name="description_benefit[]" class='form-control' placeholder="Description" rows="1" required></textarea>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-primary btn-lg edit-benefit ">edit</button>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-danger btn-lg remove-benefit">Remove</button>
                    </div>
                </div>`;
        $('#benefits-container').append(benefitTemplate);

    });

    //Add Question and Answer
    $('#add-question').click(function() {
        const questionTemplate = `
                <div class="question row pt-3">
                    <div class="col-lg-10 col-12">
                        <input type="text" name="question[]" class='form-control' placeholder="Question" required>
                    </div>
                    <div class="col-lg-10 mt-2 col-12">
                        <input type="text" name="answer[]" class='form-control' placeholder="Answer..." required>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-primary btn-lg edit-question ">edit</button>
                    </div>
                    <div class="col-lg-1 w-100 col-12">
                        <button type="button" class="btn btn-danger btn-lg remove-question">Remove</button>
                    </div>
                </div>`;
        $('#questions-container').append(questionTemplate);
    });

    //Remove Quuestion and Answer
    $('#questions-container').on('click', '.remove-question', function() {
        $(this).closest('.question').remove();
    });

    // Remove benefit
    $('#benefits-container').on('click', '.remove-benefit', function() {
        $(this).closest('.benefit').remove();
    });

    // Remove feature
    $('#features-container').on('click', '.remove-feature', function() {
        $(this).closest('.feature').remove();
    });


    // Edit feature
    $('#features-container').on('click', '.edit-feature', function() {
        const featureRow = $(this).closest('.feature');
        const title = featureRow.find("input[name='title[]']").val();
        const description = featureRow.find("textarea[name='description[]']").val();
        const logo = featureRow.find("input[name='logo[]']").val();

        // Implement your edit logic here
        // You may want to use a modal to edit the details
    });


    // Edit benefit
    $('#benefits-container').on('click', '.edit-benefit', function() {
        const benefitRow = $(this).closest('.benefit');
        const description = benefitRow.find("textarea[name='description[]']").val();
        // Implement your edit logic here
        // You may want to use a modal to edit the details
    });

    // add product
    $('#myProductForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        // Create FormData object
        $.ajax({
            url: "{{ route('product.store') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response)

                if (response.status == 400) {
                    $('#titleError').html('');
                    $('#imageError').html();
                    $('#descriptionError').html('');
                    $('#shortdescriptionError').html('');
                    $('#bg_image1Error').html('');
                    $('#bg_image2Error').html('');

                    $.each(response.errors, function(key, err_value) {
                        $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                    });
                } else {
                    $('#alert-container').html('<div class="alert alert-success">' + response.success + '</div>');
                    $('#myProductForm')[0].reset();
                    $('#features-container').empty();
                    $.get(window.location.href, function(data) {
                        var newTbody = $(data).find('.table-responsive #productId').html();
                        $('.table-responsive #productId').html(newTbody);
                    });
                }
            }

        });
    });
</script>

@endsection