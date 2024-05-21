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

            <div>
                <form class="new-added-form" id="myProductForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6 col-12 form-group">
                            <label>Top background Photo</label>
                            <input type="file" class="form-control-file" value="{{old('bg_image1')}}" id="bg_image1" name="bg_image1">
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
                        <!-- <div class="col-lg-6 col-12 form-group">
                            <label>Feature</label>
                            Button trigger modal
                            <div>
                                <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#featureModal">
                                    Add feature
                                </button>
                            </div>

                        </div> -->
                        <div class="col-12 form-group">
                            <label>Add features</label>
                            <div class="w-100 border">

                                <button type="button" id="add-feature" class="w-100">Add Feature</button>
                            </div>
                            <div id="features-container">
                                <!-- Dynamic fields will be added here -->
                            </div>

                        </div>

                        <div class="col-lg-6 col-12 form-group">
                            <label>Benefit</label>
                            <!-- Button trigger modal -->
                            <div>
                                <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#benefitModal">
                                    Add Benefit
                                </button>
                            </div>

                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Question</label>
                            <!-- Button trigger modal -->
                            <div>
                                <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#questionModal">
                                    Add Question
                                </button>
                            </div>

                        </div>
                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        </div>
                    </div>

                </form>
            </div>

            <!-- add feature -->

            <!-- <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="featureModalLabel">Add Feature</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="featuremyForm" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="product_id" name="product_id">
                                <div class="row">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo" name="logo">

                                        <div id="logoError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Title</label>
                                        <input type="text" placeholder="Title" id="feature_title" value="{{old('title')}}" class="form-control" name="title">
                                        <div id="featuretitleError"></div>
                                    </div>

                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='feature_description' class="form-control" name="description">{{old('description')}}</textarea>
                                        <div id="featuredescriptionError"></div>
                                    </div>

                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div> -->





            <!-- add benefit  -->
            <div class="modal fade" id="benefitModal" tabindex="-1" aria-labelledby="benefitModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="benefitModalLabel">Add Benefit</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="benefitmyForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="benefit_id">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='benefit_description' class="form-control" name="description">{{old('description')}}</textarea>
                                        <div id="benefitdescriptionError"></div>
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


            <!-- add image -->
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="imageModalLabel">Add Feature</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="imagemyForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="image_id">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('image')}}" id="image" name="image">

                                        <div id="imageError"></div>
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

            <!-- add question -->
            <div class="modal fade" id="questionModal" tabindex="-1" aria-labelledby="questionModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="questionModalLabel">Add Feature</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="questionmyForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="question_id">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Question</label>
                                        <input type="text" placeholder="Question" id="question" value="{{old('question')}}" class="form-control" name="question">
                                        <div id="questionError"></div>
                                    </div>

                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Answer</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Answer..." id='answer' class="form-control" name="answer">{{old('answer')}}</textarea>
                                        <div id="answerError"></div>
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


            <!--Product table data  -->

            <div class="table-responsive mt-4">
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
                    <tbody id="productId">
                        @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->title }}</td>
                            <td>
                                <div class="d-flex flex-row gap-4 font-semibold">
                                    <div class="px-1">

                                        <div>
                                            <button type="button" class="fw-btn-fill btn-gradient-yellow add-feature-btn" data-toggle="modal" data-target="#featureModal" onclick="addfeature('{{$product->id}}')">
                                                Add feature
                                            </button>

                                        </div>

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
    <!-- Add New product Area End Here -->
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
    </footer>
</div>
@endsection


@section('scripts')


<script>
    // Add feature
    $('#add-feature').click(function() {
        const featureTemplate = `
                <div class="feature row pt-3">
                    <div class="col-lg-3 col-12">
                        <input type="file" name="logo[]" accept="image/*" class='form-control' required>
                    </div>
                    <div class="col-lg-3 col-12">
                        <input type="text" name="title[]" class='form-control' placeholder="Title" required>
                    </div>
                    <div class="col-lg-4 col-12">
                        <textarea name="description[]" class='form-control' placeholder="Description" rows="1" required></textarea>
                    </div>
                    <div class="col-lg-2 col-12">
                        <button type="button" class="btn btn-danger remove-feature">Remove</button>
                    </div>
                </div>`;
        $('#features-container').append(featureTemplate);
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




    function addfeature(id) {
        console.log(id);
        $('#product_id').val(id);
    }

    // add product
    $(document).ready(function() {
        $('#myProductForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            // Create FormData object
            $.ajax({
                url: "{{ route('product.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
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
                        $('#productId').append(`<tr><td>${response.product.id}</td><td>${response.product.title}</td><td>
                        <div class="d-flex flex-row gap-4 font-semibold">
                            <div class="px-1">
                                <button type="button" class="fw-btn-fill btn-gradient-yellow add-feature-btn" data-toggle="modal" data-target="#featureModal" onclick="addFeature(${response.product.id})">
                                    Add Feature
                                </button>
                            </div>
                        </div>
                    </td></tr>`);
                        $('#myProductForm')[0].reset();
                    }
                }

            });
        });
    });



    $(`#featureForm${productId}`).submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: '/admin/products/' + productId + '/features',

            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>

@endsection