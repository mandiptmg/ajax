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
            <li>Testimonial section</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Testimonials</h3>
                </div>
                <!-- Button trigger modal -->
                <div>
                    <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                        Add Testimonial
                    </button>
                </div>
            </div>


            <!-- add testimonial -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Add Testimonail</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control-file" value="{{old('product_name')}}" id="product_name" name="product_name">

                                        <div id="product_nameError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo" name="logo">

                                        <div id="logoError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Full Name" id="name" value="{{old('name')}}" class="form-control" name="name">
                                        <div id="nameError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Occuption</label>
                                        <input type="text" placeholder="Your occupation" id="occupation" value="{{old('occupation')}}" class="form-control" name="occupation">
                                        <div id="occupationError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='description' class="form-control" name="description">{{old('description')}}</textarea>
                                        <div id="descriptionError"></div>
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

            <!-- edit testimonial -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Testimonail</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="editform" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <input type="hidden" name="testimonial_id" id="testimonial">

                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="text" class="form-control-file" value="{{old('product_name')}}" id="product_name1" name="product_name">

                                        <div id="product_nameError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Upload Photo</label>
                                        <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo1" name="logo">

                                        <div id="logoError"></div>


                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Name</label>
                                        <input type="text" placeholder="Full Name" id="name1" value="{{old('name')}}" class="form-control" name="name">
                                        <div id="nameError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Occuption</label>
                                        <input type="text" placeholder="Your occupation" id="occupation1" value="{{old('occupation')}}" class="form-control" name="occupation">
                                        <div id="occupationError"></div>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description</label>
                                        <textarea rows="9" cols="10" type="text" placeholder="Description..." id='description1' class="form-control" name="description">{{old('description')}}</textarea>
                                        <div id="descriptionError"></div>
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
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Testimonial</h3>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                                {{csrf_field()}}
                                {{method_field('DELETE')}}
                                <div class=" form-group">

                                    <input type="hidden" id="testimonial_id" name="testimonial_id">
                                    <div class="">
                                        Are you Sure ? You want to delete this Testimonial.
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


            <!-- table data  -->
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
                            <th>image</th>
                            <th>product name</th>
                            <th>name</th>
                            <th>occupation</th>
                            <th>description</th>
                            <th>Action</th>

                        </tr>

                    </thead>
                    <tbody id="testimonialId">
                        @foreach ($testimonials as $key=>$testimonial)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td><img src="{{ asset('uploads/logo/'.$testimonial->image) }}" alt="" height="20px" width="40px" class="rounded-circle "></td>
                            <td>{{ $testimonial->product_name }}</td>
                            <td>{{ $testimonial->name }}</td>
                            <td>{{ $testimonial->occupation }}</td>
                            <td>{{ $testimonial->ShortDescription }}</td>
                            <td>
                                <div class="d-flex flex-row gap-4 font-semibold">
                                    <div class="px-1">

                                        <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($testimonial->id) }}','{{ addslashes($testimonial->product_name) }}', '{{ addslashes($testimonial->name) }}', '{{ addslashes($testimonial->occupation) }}', '{{ addslashes($testimonial->description) }}', '{{ addslashes($testimonial->image) }}')" data-toggle="modal" data-target="#editModal">
                                            Edit
                                        </button>

                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($testimonial->id) }}')" class="btn btn-danger btn-lg">Delete</button>
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
        var address = "{{url('admin/testimonials/delete')}}" + '/' + id;
        form.prop('action', address);
    }

    function edit(id, product_name, name, occupation, description, image) {
        $('#product_name1').val(product_name);
        $('#name1').val(name);
        $('#occupation1').val(occupation);
        $('#description1').val(description);
        $('#testimonial').val(id);

    }
    $(document).ready(function() {
        $('#editform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            var testimonialId = formData.get('testimonial_id');
            console.log(testimonialId);

            $.ajax({
                url: "{{ url('admin/testimonials/') }}" + '/' + testimonialId,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response)

                    if (response.status == 400) {
                        $('#product_nameError').html('');
                        $('#nameError').html('');
                        $('#descriptionError').html('');
                        $('#logoError').html('');
                        $('#occupationError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('form')[1].reset();
                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success');
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #testimonialId').html();
                            $('.table-responsive #testimonialId').html(newTbody);
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
                url: "{{ route('testimonial.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response)

                    if (response.status == 400) {
                        $('#product_nameError').html('');
                        $('#nameError').html('');
                        $('#descriptionError').html('');
                        $('#logoError').html('');
                        $('#occupationError').html('');


                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success')
                        $('form')[0].reset();
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #testimonialId').html();
                            $('.table-responsive #testimonialId').html(newTbody);
                        });
                        $('#exampleModal').modal('hide');
                    }
                }

            });
        });
    });
</script>
@endsection