@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Creation Soft Nepal</h3>
        <ul>
            <li><a href="{{ url('admin/dashboard') }}">Home</a></li>
            <li>Product section</li>
        </ul>
    </div>
    <div class="card height-auto">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Create Product</h3>
                <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}">Back</a>
            </div>
            <div id="alert-container"></div>
            <div>
                <form class="new-added-form" id="myProductForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 col-12 form-group">
                            <label>Top background Photo</label>
                            <input type="file" class="form-control-file" id="bg_image1" name="bg_image1">
                            <div id="bg_image1Error" class="error-message"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Title</label>
                            <input type="text" placeholder="Title" value="{{ old('title') }}" class="form-control" name="title">
                            <div id="titleError" class="error-message"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Short Description</label>
                            <textarea rows="9" cols="10" type="text" placeholder=""  class="form-control tinymce" name="short_description">{{ old('short_description') }}</textarea>
                            <!-- <textarea rows="9" cols="10" type="text" placeholder="Short Description..." class="form-control tinymce" name="short_description">{{ old('short_description') }}</textarea> -->
                            <div id="short_descriptionError" class="error-message"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Description</label>
                            <textarea rows="9" cols="10" type="text" placeholder="Description..." class=" form-control" name="description">{{ old('description') }}</textarea>
                            <div id="descriptionError" class="error-message"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Multiple product Image</label>
                            <input type="file" class="form-control-file" value="{{ old('image') }}" id="image" multiple name="image[]">
                            <div id="imageError" class="error-message"></div>
                        </div>
                        <div class="col-lg-6 col-12 form-group">
                            <label>Middle background Photo</label>
                            <input type="file" class="form-control-file" value="{{ old('bg_image2') }}" id="logo" name="bg_image2">
                            <div id="bg_image2Error" class="error-message"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Add features</label>
                            <div>
                                <button type="button" id="add-feature" class="btn btn-primary">Add Feature</button>
                            </div>
                            <div id="features-container"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Add Benefits</label>
                            <div>
                                <button type="button" id="add-benefit" class="btn btn-primary">Add Benefit</button>
                            </div>
                            <div id="benefits-container"></div>
                        </div>
                        <div class="col-12 form-group">
                            <label>Add Question and Answer</label>
                            <div>
                                <button type="button" id="add-question" class="btn btn-primary">Add Question and Answer</button>
                            </div>
                            <div id="questions-container"></div>
                        </div>
                        <div class="col-12 form-group mg-t-8">
                            @can('create product')
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="footer-wrap-layout1">
        <div class="copyright">© Copyrights <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
    </footer>
</div>
@endsection

@section('scripts')
<script>
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
                    <textarea name="description_feature[]" class='form-control tinymce' placeholder="Description" rows="1" required></textarea>
                </div>
                <div class="col-lg-2 w-100 col-12">
                    <button type="button" class="btn btn-danger btn-lg remove-feature">Remove</button>
                </div>
            </div>`;
        $('#features-container').append(featureTemplate);
    });

    $('#add-benefit').click(function() {
        const benefitTemplate = `
            <div class="benefit row pt-3">
                <div class="col-lg-11 col-12">
                    <textarea name="description_benefit[]" class='form-control tinymce' placeholder="Description" rows="1" required></textarea>
                </div>
                <div class="col-lg-1 w-100 col-12">
                    <button type="button" class="btn btn-danger btn-lg remove-benefit">Remove</button>
                </div>
            </div>`;
        $('#benefits-container').append(benefitTemplate);
    });

    $('#add-question').click(function() {
        const questionTemplate = `
            <div class="question row pt-3">
                <div class="col-lg-11 col-12">
                    <input type="text" name="question[]" class='form-control' placeholder="Question" required>
                </div>
                <div class="col-lg-11 mt-2 col-12">
                    <input type="text" name="answer[]" class='form-control' placeholder="Answer..." required>
                </div>
                <div class="col-lg-1 w-100 col-12">
                    <button type="button" class="btn btn-danger btn-lg remove-question">Remove</button>
                </div>
            </div>`;
        $('#questions-container').append(questionTemplate);
    });

    $('#questions-container').on('click', '.remove-question', function() {
        $(this).closest('.question').remove();
    });

    $('#benefits-container').on('click', '.remove-benefit', function() {
        $(this).closest('.benefit').remove();
    });

    $('#features-container').on('click', '.remove-feature', function() {
        $(this).closest('.feature').remove();
    });

    $('#myProductForm').submit(function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('products.store') }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == 400) {
                    $('#titleError').html('');
                    $('#imageError').html('');
                    $('#descriptionError').html('');
                    $('#short_descriptionError').html('');
                    $('#bg_image1Error').html('');
                    $('#bg_image2Error').html('');

                    $.each(response.errors, function(key, err_value) {
                        $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                    });
                } else {
                    $('#alert-container').html('<div class="alert alert-success">' + response.success + '</div>');
                    $('#myProductForm')[0].reset();
                    $('#features-container').empty();
                    $('#benefits-container').empty();
                    $('#questions-container').empty();
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