    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <!-- <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Services Section</h3>
                </div>
                <div id="result"></div>
            </div>
            <form class="new-added-form" id="myForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="service_id" name="service_id" value="{{ $services->id ?? '' }}">

                <div class="row">
                    <div class="col-lg-6 col-12 form-group">
                        <label>Title</label>
                        <input type="text" placeholder="" id="title" value="{{old('title')}}" class="form-control" name="title">
                        <div id="titleError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Description *</label>
                        <textarea rows="9" cols="10" type="text" placeholder="" id='description' class="form-control" name="description">{{old('description')}}</textarea>
                        <div id="descriptionError"></div>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Icon *</label>
                        <input type="text" placeholder="" id='icon' class="form-control" name="icon" value="{{old('icon')}}">
                        <div id="iconError"></div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="rest" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>

            </form>
        </div>

        <div class="d-flex flex-row  align-items-center m-5 w-full rounded gap-4 p-5 bg-white">
       
       <table>
             <thead>
                 <tr>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Icon</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($services as $service)
                 <tr>
                     <td>{{ $services->title }}</td>
                     <td>{{ $services->description }}</td>
                     <td>{{ $services->icon }}</td>
                    
                 </tr>
                 @endforeach
             </tbody>
         </table>
        
     </div>
      

    </div> -->