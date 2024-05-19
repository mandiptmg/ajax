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
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
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
                            <div id="shortdescriptionError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Description</label>
                            <textarea rows="9" cols="10" type="text" placeholder="Description..." id='description' class="form-control" name="description">{{old('description')}}</textarea>
                            <div id="descriptionError"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Middle background Photo</label>
                            <input type="file" class="form-control-file" value="{{old('bg_image2')}}" id="logo" name="bg_image2">
                            <div id="bg_image2Error"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Feature</label>
                            <!-- Button trigger modal -->
                            <div>
                                <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#featureModal">
                                    Add feature
                                </button>
                            </div>
                        </div>
                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        </div>
                    </div>

                </form>
            </div>


            <!-- 
            add feature -->
            <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
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
                                <div class="row">
                                    <input type="hidden" name="feature_id">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo" name="logo">

                                        <div id="logoError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Title</label>
                                        <input type="text" placeholder="Title" id="feature_title" value="{{old('feature_title')}}" class="form-control" name="feature_title">
                                        <div id="featuretitleError"></div>
                                    </div>

                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='feature_description' class="form-control" name="feature_description">{{old('feature_description')}}</textarea>
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
            </div>

            <!-- edit feature -->
            <div class="modal fade" id="featureeditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Features</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="featureeditform" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="feature_id" id="feature">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo1" name="logo">

                                        <div id="logoError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Title</label>
                                        <input type="text" placeholder="Title" id="feature_title" value="{{old('feature_title')}}" class="form-control" name="feature_title">
                                        <div id="featuretitleError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='feature_description' class="form-control" name="feature_description">{{old('feature_description')}}</textarea>
                                        <div id="featuredescriptionError"></div>
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

            <!-- Destroy Modal -->

            <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Delete feature</h3>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <div class=" form-group">

                                    <input type="hidden" id="feature_id" name="feature_id">
                                    <div class="">
                                        Are you Sure ? You want to delete this feature.
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

                        </tr>

                    </thead>
                    <tbody id="productId">
                        @foreach ($products as $key=>$product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $feature->title }}</td>
                            <td>
                                <div class="d-flex flex-row gap-4 font-semibold">
                                    <div class="px-1">

                                        <button type="button" class="btn btn-primary btn-lg">
                                            Show
                                        </button>

                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($feature->id) }}')" class="btn btn-danger btn-lg">Delete</button>
                                    </div>
                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>


        <!--Feature table data  -->
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
                        <th>image</th>
                        <th>Title</th>
                        <th>description</th>
                        <th>Action</th>

                    </tr>

                </thead>
                <tbody id="featureId">
                    @foreach ($features as $key=>$feature)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td><img src="{{ asset('uploads/logo/'.$feature->image) }}" alt="" width="50x"></td>
                        <td>{{ $feature->feature_title}}</td>
                        <td>{{ $feature->ShortDescription }}</td>
                        <td>
                            <div class="d-flex flex-row gap-4 font-semibold">
                                <div class="px-1">

                                    <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($feature->id) }}', '{{ addslashes($feature->feature_title) }}', '{{ addslashes($feature->feature_description) }}', '{{ addslashes($feature->image) }}')" data-toggle="modal" data-target="#featureeditModal">
                                        Edit
                                    </button>

                                </div>
                                <div>
                                    <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($feature->id) }}')" class="btn btn-danger btn-lg">Delete</button>
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
        var address = "{{ route('features.destroy', ':id') }}";
        address = address.replace(':id', id);
        form.prop('action', address);
    }
    // feature edit 
    function edit(id, title, description) {
        $('#feature_title').val(title);
        $('#feature_description').val(description);
        $('#feature').val(id);

    }

    // feature update 
    $(document).ready(function() {
        $('#featureeditform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            var featureId = formData.get('feature_id');
            var routeUrl = "{{ route('features.update', ['id' => ':id']) }}";
            routeUrl = routeUrl.replace(':id', featureId);
            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response)

                    if (response.status == 400) {
                        $('#featuretitleError').html('');
                        $('#featuredescriptionError').html('');
                        $('#logoError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('form')[1].reset();
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #featureId').html();
                            $('.table-responsive #featureId').html(newTbody);
                        });
                        $('#featureeditModal').modal('hide');
                    }
                }

            });
        });
    });

    //feature add
    $(document).ready(function() {
        $('#featuremyForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            $.ajax({
                url: "{{ route('features.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response)

                    if (response.status == 400) {
                        $('#featuretitleError').html('');
                        $('#featuredescriptionError').html('');
                        $('#logoError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('form')[0].reset();
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #featureId').html();
                            $('.table-responsive #featureId').html(newTbody);
                        });
                        $('#featureModal').modal('hide');
                    }
                }

            });
        });
    });
</script>
@endsection