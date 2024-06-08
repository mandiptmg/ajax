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
            <li>Site Setting</li>
        </ul>
    </div>

    <!-- Display Success or Failure Messages -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @elseif($message = Session::get('failure'))
    <div class="alert alert-danger alert-dismissible">
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <!-- Header Section Form Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Site Setting</h3>
                </div>
                <div id="result"></div>
            </div>

            <form id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="sitesetting_id" value="{{ $sitesetting->id ?? '' }}">

                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Title</label>
                            <input class="form-control" type="text" value="{{ $sitesetting->name ?? '' }}" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Email</label>
                            <input class="form-control" type="email" value="{{ $sitesetting->email ?? '' }}" name="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Contact No.</label>
                            <input class="form-control" type="text" value="{{ $sitesetting->contanct ?? '' }}" name="contanct">
                            @error('contanct')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">SMS Contact No. (optional)</label>
                            <input class="form-control" type="text" value="{{ $sitesetting->contacttwo ?? '' }}" name="contacttwo">
                            @error('contacttwo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Logo</label>
                            <input class="form-control-file" type="file" name="logo" id="logo">
                            @if(isset($sitesetting) && $sitesetting->logo)
                            <img src="{{ $sitesetting ? asset('uploads/logo/'.$sitesetting->logo) : '' }}" alt="No Image Found" class="img-fluid" />
                            @endif
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Favicon</label>
                            <input class="form-control-file" type="file" name="favicon" id="favicon">
                            @if(isset($sitesetting) && $sitesetting->favicon)
                            <img src="{{ $sitesetting ? asset('uploads/favicon/'.$sitesetting->favicon) : '' }}" alt="No Image Found" class="img-fluid"/>
                            @endif


                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Address</label>
                            <input class="form-control" type="text" value="{{ $sitesetting->address ?? '' }}" name="address">
                        </div>
                    </div>

                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Facebook</label>
                            <input class="form-control" type="url" value="{{ $sitesetting->facebook ?? '' }}" name="facebook">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Instagram</label>
                            <input class="form-control" type="url" value="{{ $sitesetting->instagram ?? '' }}" name="instagram">
                        </div>
                    </div> <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Twitter</label>
                            <input class="form-control" type="url" value="{{ $sitesetting->twitter ?? '' }}" name="twitter">
                        </div>
                    </div> <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Linkedin</label>
                            <input class="form-control" type="url" value="{{ $sitesetting->linkedin ?? '' }}" name="linkedin">
                        </div>
                    </div>


                    <div class="col-sm-12">
@can('create site setting')

                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>

@endcan
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Header Section Form End Here -->

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
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('sitesetting.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 400) {
                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message).addClass('btn btn-success');
                        // Reload the section of the page with updated data
                        $.get(window.location.href, function(data) {
                            var newContent = $(data).find('#heroId').html();
                            $('#heroId').html(newContent);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection