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
            <li>Services section</li>
        </ul>
    </div>

    <div class="dashboard-content-one">
        <div class="card height-auto">
            <div class="card-body">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif($message = Session::get('failure'))
                <div class="alert alert-success alert-danger">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div id="result"></div>

                <div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3>Services</h3>
                        </div>
                        <!-- Button trigger modal -->
                        <div>
                            @can('create service')
                            <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                                Add Service
                            </button>
                            @endcan
                        </div>
                    </div>



                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="exampleModalLabel">Add Service</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <div class="col-lg-6 col-12 form-group">
                                                <label>Title</label>
                                                <input type="text" value="{{old('title')}}" class="form-control" name="title">
                                                <div id="titleError"></div>
                                            </div>

                                            <div class="col-lg-6 col-12 form-group">
                                                <label>Icon *</label>
                                                <input type="text" placeholder="" id='' class="form-control" name="icon" value="{{old('icon')}}">
                                                <div id="iconError"></div>
                                            </div>
                                            <div class="col-lg-12 col-12 form-group">
                                                <label>Description *</label>
                                                <textarea rows="9" cols="10" type="text" placeholder="" id='' class="form-control tinymce" name="description">{{old('description')}}</textarea>
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


                    <!--Edit Modal -->

                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="new-added-form" id="editform" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <div class="row">
                                            <div class="col-lg-6 col-12 form-group">
                                                <label>Title</label>
                                                <input type="hidden" id="service_id" name="service_id">
                                                <input type="text" id="title" value="{{old('title')}}" class="form-control" name="title">
                                                <div id="titleError"></div>
                                            </div>

                                            <div class="col-lg-6 col-12 form-group">
                                                <label>Icon *</label>
                                                <input type="text" placeholder="" id='icon' class="form-control" name="icon" value="{{old('icon')}}">
                                                <div id="iconError"></div>
                                            </div>
                                            <div class="col-lg-12 col-12 form-group">
                                                <label>Description *</label>
                                                <textarea rows="9" cols="10" type="text" placeholder="" id='description' class="form-control tinymce" name="description">{{old('description')}}</textarea>
                                                <div id="descriptionError"></div>
                                            </div>

                                            <div class="col-12 form-group mg-t-8">
                                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Updated</button>
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
                                    <h3 class="modal-title fs-5" id="exampleModalLabel">Delete Service</h3>
                                </div>
                                <div class="modal-body">
                                    <form class="new-added-form" method="POST" id="deleteform" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <div class=" form-group">

                                            <input type="hidden" id="service_id" name="service_id">
                                            <div class="">
                                                Are you Sure ? You want to delete this Service.
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


                </div>


                <!-- data tabel  -->
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Icon</th>
                                <th>Action</th>

                            </tr>


                        </thead>
                        <tbody id="serviceId">
                            @foreach ($services as $key=>$service)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->ShortDescription }}</td>
                                <td>{{ $service->icon }}</td>

                                <td>
                                    <div class="d-flex flex-row gap-4 font-semibold">
                                        <div class="px-1">
                                            @can('update service')


                                            <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($service->id) }}', '{{ addslashes($service->title) }}', '{{ addslashes($service->description) }}','{{ addslashes($service->icon) }}' )" data-toggle="modal" data-target="#editModal">
                                                Edit
                                            </button>

                                            @endcan

                                        </div>
                                        <div>
                                            @can('delete service')
                                            <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($service->id) }}')" class="btn btn-danger btn-lg">Delete</button>

                                            @endcan
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
        <!-- Teacher Table Area End Here -->
        <footer class="footer-wrap-layout1">
            <div class="copyright">© Copyrights <a href="#">akkhor</a> 2019. All rights reserved. Designed by <a href="#">PsdBosS</a></div>
        </footer>
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
        var address = "{{url('admin/services/delete/')}}" + '/' + id;
        form.prop('action', address);
    }

    function edit(id, title, description, icon) {
        $('#title').val(title);
        $('#description').val(description);
        $('#icon').val(icon);
        $('#service_id').val(id);
        tinymce.get('description').setContent(description);



    }
    $(document).ready(function() {
        $('#editform').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this); // Create FormData object
            var serviceId = formData.get('service_id');
            $.ajax({
                url: "{{ url('admin/services/') }}" + '/' + serviceId,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {

                    if (response.status == 400) {
                        $('#titleError').html('');
                        $('#descriptionError').html('');
                        $('#iconError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {
                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success');
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #serviceId').html();
                            $('.table-responsive #serviceId').html(newTbody);
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
                url: "{{ route('service.store') }}",
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false, // Set content type to false for file uploads
                processData: false, // Prevent jQuery from automatically processing the data
                success: function(response) {

                    if (response.status == 400) {
                        $('#titleError').html('');
                        $('#descriptionError').html('');
                        $('#iconError').html('');

                        $.each(response.errors, function(key, err_value) {
                            $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                        });
                    } else {

                        $('#result').text(response.message);
                        $('#result').addClass('btn btn-success')
                        $('form')[0].reset();
                        // Reload the page if $services exists
                        $.get(window.location.href, function(data) {
                            var newTbody = $(data).find('.table-responsive #serviceId').html();
                            $('.table-responsive #serviceId').html(newTbody);
                        });
                        $('#exampleModal').modal('hide');

                    }
                }

            });
        });
    });
</script>
@endsection