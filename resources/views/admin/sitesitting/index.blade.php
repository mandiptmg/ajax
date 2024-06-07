@extends('layouts.adminmaster')
@section('content')
<!-- Breadcubs Area Start Here -->

<div class="breadcrumbs-area">

    <h3>Site Setting</h3>

    <ul>

        <li>

            <a href="{{url('admin/dashboard')}}">Home</a>

        </li>

        <li>Site Setting</li>

    </ul>

</div>

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

<!-- Breadcubs Area End Here -->

<!-- Student Table Area Start Here -->

<div class="card height-auto">

    <div class="card-body">

        <div class="heading-layout1">

            <div class="item-title">

                <h3>Site Setting</h3>

            </div>

        </div>

        <div>

            <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                @foreach($sitesetting as $key => $per)
                <li class="nav-item" role="presentation">
                    <a class="nav-link @if($loop->first) active @endif" id="ex1-tab-{{ $per->id }}" data-toggle="tab" href="#ex1-tabs-{{ $per->id }}" role="tab" aria-controls="ex1-tabs-{{ $per->id }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ $per->name }}</a>
                </li>

                @endforeach
                <!-- @if($sitesetting->count() < 2)
			<li class="nav-item" role="presentation">
              <a class="nav-link " id="ex1-tab" data-toggle="tab" href="#ex1-tabs" role="tab" aria-controls="ex1-tabs" aria-selected="true">Add New</a>
            </li>
			@endif -->

            </ul>

            <!-- tab content start -->
            <div class="tab-content" id="ex1-content">
                @foreach ($sitesetting as $key => $sitesetting)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="ex1-tabs-{{ $sitesetting->id }}" role="tabpanel" aria-labelledby="ex1-tab-{{ $sitesetting->id }}">
                    <form method="post" action="{{route('sitesetting.store')}}" enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <div class="col-sm-4">
                                <input class="form-control" type="hidden" value="{{$sitesetting==null?'':$sitesetting->id}}" name="id">


                                <div class="form-group">

                                    <label class="form-control-label">Business Name</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->name}}" name="name">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-sm-4">


                                <div class="form-group">

                                    <label class="form-control-label">Business Sub Name</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->subname}}" name="subname">
                                    @error('subname')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Email</label>

                                    <input class="form-control" type="email" value="{{$sitesetting==null?'':$sitesetting->email}}" name="email">

                                    @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>



                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Pan No.</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->panno}}" name="panno">
                                    @error('panno')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Contact No.</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->contanct}}" name="contanct">
                                    @error('contanct')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">SMS Contact No. (optional)</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->contacttwo}}" name="contacttwo">
                                    @error('contacttwo')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Account User</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->accountuser}}" name="accountuser">

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Account Password</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->accountpassword}}" name="accountpassword">

                                </div>

                            </div>

                            <div class="col-sm-4">

                                <div class="form-group">

                                    <label class="form-control-label">Use Account</label> <br>

                                    <input type="checkbox" name="useaccount" value="1" @if(($sitesetting!=null) && ($sitesetting->useaccount=='1')){{ 'checked' }}@endif>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="form-control-label">Logo</label>

                                    <input class="form-control-file" type="file" value="" name="logo" id="imgInp-{{ $sitesetting->id }}">

                                    @if($sitesetting==null)

                                    <img id='img-upload-{{ $sitesetting->id }}' />

                                    @else

                                    <img id='img-upload-{{ $sitesetting->id }}' src="{{ asset('uploads/logo/'.$sitesetting->logo) }}" alt="No Image Found" />

                                    @endif

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="form-control-label">Favicon</label>

                                    <input class="form-control-file" type="file" value="" name="favicon" id="imgInp1-{{ $sitesetting->id }}">



                                    @if($sitesetting==null)

                                    <img id='img-upload1-{{ $sitesetting->id }}' />

                                    @else

                                    <img id='img-upload1-{{ $sitesetting->id }}' src="{{ asset('uploads/favicon/'.$sitesetting->favicon) }}" alt="No Image Found" />

                                    @endif

                                </div>

                            </div>



                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="form-control-label">SMS Api Token</label>

                                    <input type="text" name="smsapi" value="{{$sitesetting==null?'':$sitesetting->smsapi}}" class="form-control">

                                </div>

                            </div>



                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="form-control-label">SMS For Vehicle Registration</label><br>

                                    <input type="checkbox" name="sendreg" value="1" @if(($sitesetting!=null) && ($sitesetting->sendreg=='1')){{ 'checked' }}@endif>

                                </div>

                            </div>



                            <div class="col-sm-3">

                                <div class="form-group">

                                    <label class="form-control-label">SMS For Route Assign</label><br>

                                    <input type="checkbox" name="sendroute" value="1" @if(($sitesetting!=null) && ($sitesetting->sendroute=='1')) {{ 'checked' }}@endif>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="form-control-label">Address</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->address}}" name="address">

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">

                                    <label class="form-control-label">Facebook</label>

                                    <input class="form-control" type="text" value="{{$sitesetting==null?'':$sitesetting->facebook}}" name="facebook">

                                </div>

                            </div>



                            <div class="col-sm-12">

                                <div class="form-group">

                                    <label class="form-control-label">Note to be displayed</label>

                                    <textarea class="textarea form-control" name="description" rows="9" cols="10" style="height: auto">{{$sitesetting==null?'':$sitesetting->description}}</textarea>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>

                            </div>

                        </div>

                    </form>
                </div>
                @endforeach

                <!-- @if($sitesetting->count() < 2)
			<div class="tab-pane fade " id="ex1-tabs" role="tabpanel" aria-labelledby="ex1-tab">
			<form method="post" action="{{route('sitesetting.store')}}" enctype="multipart/form-data">

				@csrf

				<div class="row">

					<div class="col-sm-6">

						<div class="form-group">

							<label class="form-control-label">Business Name</label>
							<input class="form-control" type="text"  name="name">
							@error('name')
                            	<div class="text-danger">{{ $message }}</div>
                          	@enderror

						</div>

					</div>

					<div class="col-sm-6">

						<div class="form-group">

							<label class="form-control-label">Email</label>
							<input class="form-control" type="email" name="email">
							@error('email')
                            	<div class="text-danger">{{ $message }}</div>
                          	@enderror

						</div>

					</div>



					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">Pan No.</label>

							<input class="form-control" type="text" name="panno">
							@error('panno')
                            	<div class="text-danger">{{ $message }}</div>
                          	@enderror

						</div>

					</div>

					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">Contact No.</label>

							<input class="form-control" type="text" name="contanct">
							@error('contanct')
                            	<div class="text-danger">{{ $message }}</div>
                          	@enderror

						</div>

					</div>

					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">SMS Contact No. (optional)</label>

							<input class="form-control" type="text" name="contacttwo">
							@error('contacttwo')
                            	<div class="text-danger">{{ $message }}</div>
                          	@enderror

						</div>

					</div>

					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">Account User</label>

							<input class="form-control" type="text" name="accountuser">

						</div>

					</div>

					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">Account Password</label>

							<input class="form-control" type="text" name="accountpassword">

						</div>

					</div>

					<div class="col-sm-4">

						<div class="form-group">

							<label class="form-control-label">Use Account</label> <br>

							<input type="checkbox" name="useaccount" value="1"  >

						</div>

					</div>

					<div class="col-sm-6">

						<div class="form-group">

							<label class="form-control-label">Logo</label>

							<input class="form-control-file" type="file" value="" name="logo" id="">

							<img id='img-upload' alt="No Image Found" />

							

						</div>

					</div>

					<div class="col-sm-6">

						<div class="form-group">

							<label class="form-control-label">Favicon</label>

							<input class="form-control-file" type="file" value="" name="favicon" id="imgInp1">

							<img id='img-upload1'  alt="No Image Found" />

							

						</div>

					</div>



					<div class="col-sm-6">

							<div class="form-group">

									<label class="form-control-label">SMS Api Token</label>

									<input type="text" name="smsapi"  class="form-control">

							</div>

					</div>



					<div class="col-sm-3">

							<div class="form-group">

									<label class="form-control-label">SMS For Vehicle Registration</label><br>

									<input type="checkbox" name="sendreg"  >

							</div>

					</div>



					<div class="col-sm-3">

							<div class="form-group">

									<label class="form-control-label">SMS For Route Assign</label><br>

									<input type="checkbox" name="sendroute" >

							</div>

					</div>

					<div class="col-sm-6">

						<div class="form-group">

							<label class="form-control-label">Address</label>

							<input class="form-control" type="text" name="address">

						</div>

					</div>

					

					<div class="col-sm-12">

						<div class="form-group">

							<label class="form-control-label">Note to be displayed</label>

							<textarea class="textarea form-control" name="description" rows="9" cols="10" style="height: auto"></textarea>

						</div>

					</div>

					<div class="col-sm-12">

						<button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>

					</div>

				</div>

			</form>
            </div>
			@endif -->



            </div>
            <!-- tab content end -->

        </div>




    </div>

</div>



@endsection





@section('scripts')



<script src="{{asset('js/adminjs/photoviewer.js')}}"></script>

@endsection