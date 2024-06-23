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
                <li>Policy section</li>
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
                                <h3>Policy</h3>
                            </div>
                            <!-- Button trigger modal -->
                            <div>
                                @can('create policy')
                                <button type="button" class="fw-btn-fill btn-gradient-yellow" data-toggle="modal" data-target="#exampleModal">
                                    Add Policy
                                </button>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <!-- data table -->
                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="serviceId">
                                @foreach ($policies as $key => $policy)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $policy->title }}</td>
                                    <!-- <td>{{ $policy->ShortDescription }}</td> -->
                                    <td> {!! $policy->ShortDescription !!}
                                    </td>
                                    <td>
                                        <div class="d-flex flex-row gap-4 font-semibold">
                                            <div class="btn btn-info btn-lg">
                                                @can('update policy')
                                                <a class="text-white" href="{{ route('policy.show', ['id' => $policy->id]) }}">View </a>
                                                @endcan
                                            </div>
                                            <div class="px-1">
                                                @can('update policy')
                                                <!-- <button type="button" class="btn btn-primary btn-lg" onclick="editPolicy('{{ $policy->id }}', '{{ $policy->title }}', '{{ addslashes($policy->description) }}')" data-toggle="modal" data-target="#editModal">
                                                    Edit
                                                </button> -->
                                                <button type="button" class="btn btn-primary btn-lg" 
                                                        data-policy-id="{{ $policy->id }}" 
                                                        data-title="{{$policy->title }}" 
                                                        data-description="{{$policy->description}}" 
                                                        data-toggle="modal" data-target="#editModal"
                                                        onclick="editPolicy(this)">
                                                    Edit
                                                </button>

                                                @endcan
                                            </div>
                                            <div>
                                                @can('delete policy')
                                                <button data-toggle="modal" data-target="#destroyModal" onclick="deletePolicy('{{ $policy->id }}')" class="btn btn-danger btn-lg">Delete</button>
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
        </div>

        <!-- Modal for adding new policy -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addPolicyForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-12 form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" id="addTitle">
                                    <div id="addTitleError"></div>
                                </div>
                                <div class="col-lg-12 col-12 form-group">
                                    <label>Description *</label>
                                    <textarea rows="9" class="form-control tinymce" name="description" id="addDescription"></textarea>
                                    <div id="addDescriptionError"></div>
                                </div>
                                <div class="col-12 form-group">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for editing policy -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editPolicyForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="policy_id" id="editPolicyId">
                            <div class="row">
                                <div class="col-lg-6 col-12 form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" id="editTitle">
                                    <div id="editTitleError"></div>
                                </div>
                                <div class="col-lg-12 col-12 form-group">
                                    <label>Description *</label>
                                    <textarea rows="9" class="form-control tinymce" name="description" id="editDescription"></textarea>
                                    <div id="editDescriptionError"></div>
                                </div>
                                <div class="col-12 form-group">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for confirming deletion -->
        <div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Delete Policy</h5>
                    </div>
                    <div class="modal-body">
                        <form id="deletePolicyForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="policy_id" id="deletePolicyId">
                            <div class="form-group">
                                <div>Are you sure you want to delete this Policy?</div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Delete</button>
                                    <button type="button" class="btn bg-danger btn-fill-lg ml-2" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer-wrap-layout1">
            <div class="copyright">© Copyrights
                <a href="#">Creation Soft Nepal</a> 2019. All rights reserved. Designed by
                <a href="#">PsdBosS</a>
            </div>
        </footer>
    </div>
    @endsection

    @section('scripts')
    <script>
        function destroy(id) {
            console.log(id);
            var form = $('#deleteform');
            var address = "{{url('admin/policy/delete/')}}" + '/' + id;
            form.prop('action', address);
        }
        // Function to populate data in edit modal
        // function editPolicy(id, title, description) {
        //     $('#editTitle').val(title); // Set the title input field value
        //     $('#editDescription').val(description); // Set the description textarea value
        //     $('#editPolicyId').val(id); // Set the hidden policy_id input field value
        //     tinyMCE.activeEditor.tinymce.get('editDescription').setContent(description);

        // }
        function editPolicy(button) {
    var policyId = button.getAttribute('data-policy-id');
    var title = button.getAttribute('data-title');
    var description = button.getAttribute('data-description');

    // Set the values in the modal form
    document.getElementById('editPolicyId').value = policyId;
    document.getElementById('editTitle').value = title;
    tinymce.get('editDescription').setContent(description);

    // Optionally, you can also open the modal here if needed
    $('#editModal').modal('show');
}

        

        // Function to set up AJAX for editing policy
        $(document).ready(function() {
            $('#editPolicyForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object
                var policyId = formData.get('policy_id'); // Get policy ID from hidden input
                console.log(policyId)
                $.ajax({
                    url: "{{ url('admin/policy/') }}" + '/' + policyId,
                    type: 'POST', // Ensure this is POST method
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#editTitleError').html('');
                            $('#editDescriptionError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });
                        } else {
                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success');

                            // Refresh the table data after successful update
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

        // Function to set up AJAX for adding new policy
        $(document).ready(function() {
            $('#addPolicyForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); // Create FormData object

                $.ajax({
                    url: "{{ route('policy.store') }}",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false, // Set content type to false for file uploads
                    processData: false, // Prevent jQuery from automatically processing the data

                    success: function(response) {
                        if (response.status == 400) {
                            $('#addTitleError').html('');
                            $('#addDescriptionError').html('');

                            $.each(response.errors, function(key, err_value) {
                                $('#add' + key + 'Error').html('<p class="text-danger">' + err_value + '</p>');
                            });

                        } else {
                            $('#result').text(response.message);
                            $('#result').addClass('btn btn-success');
                            $('form')[0].reset();

                            // Refresh the table data after successful addition
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

        // Function to set up AJAX for deleting policy
        function deletePolicy(id) {
            var form = $('#deletePolicyForm');
            var actionUrl = "{{ url('admin/policy/delete') }}" + '/' + id;
            form.prop('action', actionUrl);
        }
    </script>
    @endsection