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

                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input type="file" class="form-control-file" value="{{old('logo', $heroes->image ?? '')}}" id="logo" name="logo">

                        <div id="logoError"></div>


                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Video (Optional)</label>
                        <input type="file" class="form-control-file" id="video" name="video">
                        <div id="videoError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>URL (Optional)</label>
                        <input type="text" class="form-control" id="url" name="url" value="{{ old('url', $heroes->url ?? '') }}">
                        <div id="urlError"></div>
                    </div>
                    <div class="col-lg-12  col-12 form-group">
                        <label>Description *</label>
                        <textarea rows="9" cols="10" type="text" placeholder="" id='description' class="form-control tinymce" name="description">{{old('description', $heroes->description ?? '' )}}</textarea>
                        <div id="descriptionError"></div>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        @can('create hero')

                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>

                        @endcan
                    </div>
                </div>

            </form>
        </div>

        <article>
            <div id="heroId" class="d-flex flex-row  align-items-center m-5 w-full rounded gap-4 p-5 bg-white">
                @if($heroes)

                <div>
                    <div class="">
                        {{$heroes->title}}
                    </div>
                    <div>
                        {{$heroes->description}}
                    </div>
                    <div>
                        {{$heroes->url}}
                    </div>
                    <div>
                        {{$heroes->video}}
                    </div>
                 

                </div>
                <img src="{{asset('uploads/logo/'.$heroes->image)}}" alt="" width="350px" height="350px">


                @endif
            </div>
        </article>

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
                        $('#videoError').html('');
                        $('#urlError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success')
                        $('form')[0].reset();
                        // Reload the page if $heroes exists
                        $.get(window.location.href, function(data) {
                            var newDev = $(data).find('article #heroId ').html();
                            $('article #heroId').html(newDev);
                        });
                    }
                }

            });
        });
    });
</script>
@endsection