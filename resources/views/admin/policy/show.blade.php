<!-- resources/views/admin/product/show.blade.php -->
@extends('layouts.adminmaster')
@section('content')
<div class="dashboard-content-one">
    <div class="breadcrumbs-area">
        <h3>Product Details</h3>
        <ul>
            <li>
                <a href="{{url('admin/dashboard')}}">Home</a>

            </li>
            <li>Policy Details</li>
        </ul>
    </div>

    <div class="card height-auto">
        <div class="card-body">
            <h3>{{ $policy->title }}</h3>
            <p>{{ $policy->description }}</p>
        </div>
    </div>
</div>
@endsection