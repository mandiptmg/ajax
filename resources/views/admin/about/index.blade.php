@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Creation Soft Nepal</h3>
        <ul>
            <li>
                <a href="{{url('admin/dashboard')}}">Home</a>
            </li>
            <li>About section</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->
    <!-- Add New About Area Start Here -->
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
                <input type="hidden" id="about_id" name="about_id" value="{{ $abouts->id ?? '' }}">

                <div class="row">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Title</label>
                        <input type="text" placeholder="" id="title" value="{{old('title',$abouts->title ?? '')}}" class="form-control" name="title">
                        <div id="titleError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Subtitle</label>
                        <input type="text" placeholder="" id="subtitle" value="{{old('subtitle',$abouts->subtitle ?? '')}}" class="form-control" name="subtitle">
                        <div id="subtitleError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Logo (150px X 150px)</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                        <div id="logoError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Description *</label>
                        <textarea rows="9" cols="10" id="description" class="form-control tinymce" name="description">{{old('description', $abouts->description ?? '')}}</textarea>
                        <div id="descriptionError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon mission</label>
                        <input type="text" placeholder="" id="icon1" value="{{old('icon1',$abouts->icon1 ?? '')}}" class="form-control" name="icon1">
                        <div id="icon1Error"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon vision</label>
                        <input type="text" placeholder="" id="icon2" value="{{old('icon2',$abouts->icon2 ?? '')}}" class="form-control" name="icon2">
                        <div id="icon2Error"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon support</label>
                        <input type="text" placeholder="" id="icon3" value="{{old('icon3',$abouts->icon3 ?? '')}}" class="form-control" name="icon3">
                        <div id="icon3Error"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon team</label>
                        <input type="text" placeholder="" id="icon4" value="{{old('icon4',$abouts->icon4 ?? '')}}" class="form-control" name="icon4">
                        <div id="icon4Error"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon code</label>
                        <input type="text" placeholder="" id="icon5" value="{{old('icon5',$abouts->icon5 ?? '')}}" class="form-control" name="icon5">
                        <div id="icon5Error"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Mission Title</label>
                        <input type="text" placeholder="" id="title_mission" value="{{old('title_mission',$abouts->title_mission ?? '')}}" class="form-control" name="title_mission">
                        <div id="title_missionError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Mission Description</label>
                        <textarea rows="9" cols="10" id="description_mission" class="form-control tinymce" name="description_mission">{{old('description_mission', $abouts->description_mission ?? '')}}</textarea>
                        <div id="description_missionError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Vision Title</label>
                        <input type="text" placeholder="" id="title_vision" value="{{old('title_vision',$abouts->title_vision ?? '')}}" class="form-control" name="title_vision">
                        <div id="title_visionError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Vision Description</label>
                        <textarea rows="9" cols="10" id="description_vision" class="form-control tinymce" name="description_vision">{{old('description_vision', $abouts->description_vision ?? '')}}</textarea>
                        <div id="description_visionError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Why Us Title</label>
                        <input type="text" placeholder="" id="why_us" value="{{old('why_us',$abouts->why_us ?? '')}}" class="form-control" name="why_us">
                        <div id="why_usError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Why Us Description</label>
                        <textarea rows="9" cols="10" id="description_why" class="form-control tinymce" name="description_why">{{old('description_why', $abouts->description_why ?? '')}}</textarea>
                        <div id="description_whyError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Support Title</label>
                        <input type="text" placeholder="" id="title_support" value="{{old('title_support',$abouts->title_support ?? '')}}" class="form-control" name="title_support">
                        <div id="title_supportError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Support Description</label>
                        <textarea rows="9" cols="10" id="description_support" class="form-control tinymce" name="description_support">{{old('description_support', $abouts->description_support ?? '')}}</textarea>
                        <div id="description_supportError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Team Title</label>
                        <input type="text" placeholder="" id="title_team" value="{{old('title_team',$abouts->title_team ?? '')}}" class="form-control" name="title_team">
                        <div id="title_teamError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Team Description</label>
                        <textarea rows="9" cols="10" id="description_team" class="form-control tinymce" name="description_team">{{old('description_team', $abouts->description_team ?? '')}}</textarea>
                        <div id="description_teamError"></div>
                    </div>

                    <div class="col-lg-6 col-12 form-group">
                        <label>Code Title</label>
                        <input type="text" placeholder="" id="title_code" value="{{old('title_code',$abouts->title_code ?? '')}}" class="form-control" name="title_code">
                        <div id="title_codeError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Code Description</label>
                        <textarea rows="9" cols="10" id="description_code" class="form-control tinymce" name="description_code">{{old('description_code', $abouts->description_code ?? '')}}</textarea>
                        <div id="description_codeError"></div>
                    </div>

                    <div class="col-lg-12 col-12 form-group">
                        <label>Upload Images</label>
                        <input type="file" class="form-control-file" id="image1" name="image1[]" multiple>
                        <div id="image1Error"></div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        @can('create about')
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        @endcan
                    </div>
                </div>
            </form>
        </div>

        <article>
            <div id="aboutId" class="d-flex flex-row align-items-center m-5 w-full rounded gap-4 p-5 bg-white">
                @if($abouts)
                <div>
                    <div>{{ $abouts->title }}</div>
                    <div>{{ $abouts->description }}</div>
                </div>
                <img src="{{ asset('uploads/logo/' . $abouts->image) }}" alt="" width="350px" height="350px">
                @endif
            </div>
        </article>
    </div>
    <!-- Add New About Area End Here -->
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
                url: "{{ route('about.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {
                    $('#titleError').html('');
                    $('#subtitleError').html('');
                    $('#logoError').html('');
                    $('#icon1Error').html('');
                    $('#icon2Error').html('');
                    $('#icon3Error').html('');
                    $('#icon4Error').html('');
                    $('#icon5Error').html('');
                    $('#title_missionError').html('');
                    $('#description_missionError').html('');
                    $('#title_visionError').html('');
                    $('#description_visionError').html('');
                    $('#why_usError').html('');
                    $('#description_whyError').html('');
                    $('#title_supportError').html('');
                    $('#description_supportError').html('');
                    $('#title_teamError').html('');
                    $('#description_teamError').html('');
                    $('#title_codeError').html('');
                    $('#description_codeError').html('');
                    $('#image1Error').html('');
                    $('#logoError').html('');

                    if (response.status == 400) {
                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message).addClass('btn btn-success').fadeOut(5000);
                        $('#myForm')[0].reset();
                        $.get(window.location.href, function(data) {
                            var newContent = $(data).find('article #aboutId').html();
                            $('article #aboutId').html(newContent);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    $('#result').text('An error occurred. Please try again.').addClass('btn btn-danger').fadeOut(5000);
                }
            });
        });
    });
</script>
@endsection
