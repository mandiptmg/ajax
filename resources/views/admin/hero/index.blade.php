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
            <li>Hero section</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Hero Section</h3>
                </div>

            </div>
            <form class="new-added-form" method="POST" id="submitbutton" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Title</label>
                        <input type="text" placeholder="" id="title" class="form-control" name="title">
                        <div id="titleError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Description *</label>
                        <textarea rows="9" cols="10" type="text" placeholder="" id='description' class="form-control" name="description"></textarea>
                        <div id="descriptionError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input type="file" class="form-control-file" id="photo" name="photo">

                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
            </form>
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
    $(document).ready(function() {
        $('#submitbutton').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // Create FormData object for form data including file upload
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{route('hero.store')}}",
                data: formData, // Use FormData for file uploads
                processData: false, // Don't process the data
                contentType: false, // Don't set contentType
                success: function(response) {
                    console.log(formData);
                    // If validation fails, display errors
                    if (response.status == 400) {
                        $('#titleError').html('');
                        $('#titleError').addClass('alert alert-danger');
                        $('#descriptionError').html('');
                        $('#descriptionError').addClass('alert alert-danger');

                        // Display errors generically
                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p>' + err_value + '</p>');
                        });
                    } else {
                        console.log('test');
                    }
                },
                error: function(data) {
                    console.error(data.responseText); // Log any errors for debugging
                }
            });
        });
    });
</script>
@endsection