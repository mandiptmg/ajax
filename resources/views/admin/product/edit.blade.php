<!-- resources/views/admin/product/edit.blade.php -->
@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Edit Product</h3>
        <ul>
            <li>
                <a href="{{ url('admin') }}">Home</a>
            </li>
            <li>Edit Product</li>
        </ul>
    </div>

    <div class="card height-auto">
        <div class="card-body">
            <h3>Edit Product</h3>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form class="new-added-form" id="updateProductForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <div class="col-lg-6 col-12 form-group">
                        <label>Top background Photo</label>
                        <input type="file" class="form-control-file" value="{{$product->bg_image1 ?? ''}}" id="bg_image1" name="bg_image1">
                        <img src="{{ asset('uploads/bg_images/' . $product->bg_image1 ?? '' ) }}" alt="Top Background Photo" class="img-fluid">
                        <div id="bg_image1Error"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Title</label>
                        <input type="text" placeholder="Title" id="title" value="{{ $product->title }}" class="form-control" name="title">
                        <div id="titleError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Short Description</label>
                        <textarea rows="9" cols="10" placeholder="Short Description..." id='short_description' class="form-control" name="short_description">{{ $product->short_description }}</textarea>
                        <div id="short_descriptionError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Description</label>
                        <textarea rows="9" cols="10" placeholder="Description..." id='description' class="form-control" name="description">{{ $product->description }}</textarea>
                        <div id="descriptionError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Multiple Product Image</label>
                        <input type="file" class="form-control-file" id="image" multiple name="image[]">

                        <div id="imageError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Middle background Photo</label>
                        <input type="file" class="form-control-file" id="bg_image2" name="bg_image2">
                        <img src="{{ asset('uploads/bg_images2/' . $product->bg_image2) }}" alt="Middle Background Photo" class="img-fluid">
                        <div id="bg_image2Error"></div>
                    </div>

                    <!-- Features Section -->
                    <div class="col-12 form-group">
                        <label>Add features</label>
                        <button type="button" id="add-feature" class="btn btn-primary">Add Feature</button>
                        <div id="features-container">
                            @foreach($product->features as $feature)

                            <div class="feature row pt-3">
                                <div class="col-lg-1 col-12">
                                    <input type="checkbox" class="feature-checkbox" checked>
                                </div>
                                <div class="col-lg-3 col-12">
                                    <input type="file" name="logo[]" accept="image/*" class='form-control'>
                                    <img src="{{ asset('uploads/features/' . $feature->logo) }}" alt="{{ $feature->title }}" class="img-fluid">
                                </div>
                                <div class="col-lg-3 col-12">
                                    <input type="text" name="title_feature[]" class='form-control' value="{{ $feature->title }}" placeholder="Title" required>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <textarea name="description_feature[]" class='form-control' placeholder="Description" rows="1" required>{{ $feature->description }}</textarea>
                                </div>
                                <div class="col-lg-1 col-12">
                                    <button type="button" class="btn btn-danger btn-lg remove-feature" data-id="{{ $feature->id }}">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Benefits Section -->
                    <div class="col-12 form-group">
                        <label>Add Benefits</label>
                        <button type="button" id="add-benefit" class="btn btn-primary">Add Benefit</button>
                        <div id="benefits-container">
                            @foreach($product->benefits as $benefit)
                            <div class="benefit row pt-3">
                                <div class="col-lg-10 col-12">
                                    <textarea name="description_benefit[]" class='form-control' placeholder="Description" rows="1" required>{{ $benefit->description }}</textarea>
                                </div>
                                <div class="col-lg-1 col-12">
                                    <button type="button" class="btn btn-danger btn-lg remove-benefit" data-id="{{ $benefit->id }}">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Questions Section -->
                    <div class="col-12 form-group">
                        <label>Add Questions and Answers</label>
                        <button type="button" id="add-question" class="btn btn-primary">Add Question and Answer</button>
                        <div id="questions-container">
                            @foreach($product->questionAnswers as $question)
                            <div class="question row pt-3">
                                <div class="col-lg-10 col-12">
                                    <input type="text" name="question[]" class='form-control' value="{{ $question->question }}" placeholder="Question" required>
                                </div>
                                <div class="col-lg-10 mt-2 col-12">
                                    <input type="text" name="answer[]" class='form-control' value="{{ $question->answer }}" placeholder="Answer" required>
                                </div>
                                <div class="col-lg-1 col-12">
                                    <button type="button" class="btn btn-danger btn-lg remove-question" data-id="{{ $question->id }}">Remove</button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // CSRF Token setup for AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Enable/disable feature fields based on checkbox status
    $('#features-container').on('change', '.feature-checkbox', function() {
        const isChecked = $(this).prop('checked');
        const featureRow = $(this).closest('.feature');
        featureRow.find('input[type="file"], input[type="text"], textarea').prop('disabled', !isChecked);
    });


    // Initially disable fields for unchecked checkboxes and leave checked ones as is
    $('#features-container .feature-checkbox').each(function() {
        const featureRow = $(this).closest('.feature');
        featureRow.find('input[type="file"], input[type="text"], textarea').prop('disabled', true);
        $(this).prop('checked', false); // Uncheck the checkbox
    });


    // Feature template
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
        <div class="col-lg-1 col-12">
            <button type="button" class="btn btn-danger btn-lg remove-feature">Remove</button>
        </div>
    </div>`;

    // Benefit template
    const benefitTemplate = `
    <div class="benefit row pt-3">
        <div class="col-lg-10 col-12">
            <textarea name="description_benefit[]" class='form-control' placeholder="Description" rows="1" required></textarea>
        </div>
        <div class="col-lg-1 col-12">
            <button type="button" class="btn btn-danger btn-lg remove-benefit">Remove</button>
        </div>
    </div>`;

    // Question template
    const questionTemplate = `
    <div class="question row pt-3">
        <div class="col-lg-10 col-12">
            <input type="text" name="question[]" class='form-control' placeholder="Question" required>
        </div>
        <div class="col-lg-10 mt-2 col-12">
            <input type="text" name="answer[]" class='form-control' placeholder="Answer" required>
        </div>
        <div class="col-lg-1 col-12">
            <button type="button" class="btn btn-danger btn-lg remove-question">Remove</button>
        </div>
    </div>`;


    // Add dynamic fields
    $('#add-feature').click(function() {
        $('#features-container').append(featureTemplate);
    });
    $('#add-benefit').click(function() {
        $('#benefits-container').append(benefitTemplate);
    });
    $('#add-question').click(function() {
        $('#questions-container').append(questionTemplate);
    });

    // Remove dynamic fields
    $('#features-container').on('click', '.remove-feature', function() {
        $(this).closest('.feature').remove();
    });
    $('#benefits-container').on('click', '.remove-benefit', function() {
        $(this).closest('.benefit').remove();
    });
    $('#questions-container').on('click', '.remove-question', function() {
        $(this).closest('.question').remove();
    });


    // Handle form submission
    $('#updateProductForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ url('admin/products/' . $product->id) }}",
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 400) {
                    $.each(response.errors, function(key, error) {
                        $('#' + key + 'Error').html('<p class="text-danger">' + error + '</p>');
                    });
                } else {
                    window.location.href = "{{ url('admin/products') }}";
                }
            }
        });
    });
</script>
@endsection