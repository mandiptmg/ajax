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
            <li>About section</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>About Section</h3>
                </div>
                <div id="result"></div>
            </div>
            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="hero_id" name="hero_id" value="{{ $heroes->id ?? '' }}">

                <div class="row">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Title</label>
                        <input type="text" placeholder="" id="title" value="{{old('title',$heroes->title ?? '')}}" class="form-control" name="title">
                        <div id="titleError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Description *</label>
                        <textarea rows="9" cols="10" type="text" placeholder="" id='description' class="form-control" name="description">{{old('description', $heroes->description ?? '' )}}</textarea>
                        <div id="descriptionError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input type="file" class="form-control-file" value="{{old('logo', $heroes->image ?? '')}}" id="logo" name="logo">

                        <div id="logoError"></div>


                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="rest" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>



                    </div>
                </div>

            </form>
        </div>


        <div class="d-flex flex-row  align-items-center m-5 w-full rounded gap-4 p-5 bg-white">
            @if($heroes)

            <div>
                <div class="">
                    {{$heroes->title}}
                </div>
                <div>
                    {{$heroes->description}}
                </div>
            </div>
            <img src="{{asset('uploads/logo/'.$heroes->image)}}" alt="" width="350px" height="350px">


            @endif
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
        $('#myForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            $.ajax({
                url: "{{ route('hero.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {

                    if (response.status == 400) {
                        $('#titleError').html('');
                        $('#descriptionError').html('');
                        $('#logoError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success')
                        $('form')[0].reset();
                        // Reload the page if $heroes exists
                    @if($heroes)
                        location.reload();
                    @endif
                    }
                }

            });
        });
    });
</script>
@endsection