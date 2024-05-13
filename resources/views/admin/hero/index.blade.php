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
            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
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
                        <input type="file" class="form-control-file" id="logo" name="logo">

                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
                <div id="titleError"></div>

            </form>
        </div>
        <div id="result"></div>

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
        $('#myForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            console.log(formData);
            $.ajax({
                url: "{{ route('hero.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    console.log(response);
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
                        console.log('data passed');

                        $('#result').text(response.message);
                        $('form')[0].reset();
                    }
                }

            });
        });
    });
</script>
@endsection