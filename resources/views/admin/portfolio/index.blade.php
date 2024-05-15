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
            <li>Portfolio section</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
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

    <div class="card height-auto">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3>Portfolios</h3>
                </div>
                <!-- Button trigger modal -->
                <div>
                    <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                        Add Portfolio
                    </button>
                </div>
            </div>

            <!-- add portfolio -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title fs-5" id="exampleModalLabel">Edit Service</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                                @csrf


                                <div class="row">

                                    <div class="d-flex w-full form-group mg-t-30">
                                        <div class="w-full"> <label class="text-dark-medium">Upload Portfolio Photo</label>
                                            <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo" name="logo">
                                            <div id="logoError"></div>
                                        </div>

                                        <div class="w-full form-group">
                                            <label>Url address </label>
                                            <input type="url" placeholder="" id="url" value="{{old('url')}}" class="form-control w-full" name="url">
                                            <div id="urlError"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                        <button type="rest" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>



                                    </div>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </div>



            <!--Edit Modal -->

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
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
                                    <input type="hidden" id="portfolio" name="portfolio_id">

                                    <div class="d-flex w-full form-group mg-t-30">
                                        <div class="w-full"> <label class="text-dark-medium">Upload Portfolio Photo</label>
                                            <input type="file" class="form-control-file" value="{{old('logo')}}" id="logo" name="logo">
                                            <div id="logoError"></div>
                                        </div>

                                        <div class="w-full form-group">
                                            <label>Url address </label>
                                            <input type="url" placeholder="" id="url1" value="{{old('url')}}" class="form-control w-full" name="url">
                                            <div id="urlError"></div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group mg-t-8">
                                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                        <button type="rest" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>



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

                                    <input type="hidden" id="portfolio_id" name="portfolio_id">
                                    <div class="">
                                        Are you Sure ? You want to delete this Portfolio.
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
                            <th>url</th>
                            <th>image</th>
                            <th>Action</th>

                        </tr>


                    </thead>
                    <tbody>
                        @foreach ($portfolios as $key=>$portfolio)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $portfolio->url }}</td>
                            <td><img src="{{ asset('uploads/logo/'.$portfolio->image) }}" alt="" width="50x"></td>

                            <td>
                                <div class="d-flex flex-row gap-4 font-semibold">
                                    <div class="px-1">


                                        <button type="button" class="btn btn-primary btn-lg" onclick="edit('{{ addslashes($portfolio->id) }}', '{{ addslashes($portfolio->url) }}', '{{ addslashes($portfolio->image) }}')" data-toggle="modal" data-target="#editModal">
                                            Edit
                                        </button>

                                    </div>
                                    <div>
                                        <button data-toggle="modal" data-target="#destroyModal" onclick="destroy('{{ addslashes($portfolio->id) }}')" class="btn btn-danger btn-lg">Delete</button>
                                    </div>
                                </div>

                            </td>

                        </tr>
                        @endforeach
                    </tbody>

                </table>
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
            var address = "{{url('admin/portfolios/')}}" + '/' + id;
            form.prop('action', address);
        }

        function edit(id, url, image) {
            $('#url1').val(url);
            $('#portfolio').val(id);

        }
        $(document).ready(function() {
            $('#editform').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object
                var portfolioId = formData.get('portfolio_id');
                console.log(portfolioId);

                $.ajax({
                    url: "{{ url('admin/portfolios/') }}" + '/' + portfolioId,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {
                            $('#urlError').html('');
                            $('#logoError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {
                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success')
                            $('form')[0].reset();
                            // Reload the page if $services exists
                            @if($portfolios)
                            location.reload();
                            @endif
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
                    url: "{{ route('portfolio.store') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data
                    success: function(response) {

                        if (response.status == 400) {
                            $('#urlError').html('');
                            $('#logoError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {
                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success')
                            $('form')[0].reset();
                            // Reload the page if $portfolios exists
                            @if($portfolios)
                            location.reload();
                            @endif
                        }
                    }

                });
            });
        });
    </script>
    @endsection