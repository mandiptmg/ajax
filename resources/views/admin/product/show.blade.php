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
            <li>Product Details</li>
        </ul>
    </div>

    <div class="card height-auto">
        <div class="card-body">
            <h3>{{ $product->title }}</h3>
            <p>{{ $product->description }}</p>
            <img src="{{ asset('uploads/bg_images/' . $product->bg_image1) }}" alt="Top Background Photo" class="img-fluid">
            <img src="{{ asset('uploads/bg_images2/' . $product->bg_image2) }}" alt="Middle Background Photo" class="img-fluid">

            <h4>Features</h4>
            <ul>
                @foreach($product->features as $feature)
                <li>
                    <h5>{{ $feature->title }}</h5>
                    <p>{{ $feature->description }}</p>
                    <img src="{{ asset('uploads/features/' . $feature->logo) }}" alt="{{ $feature->title }}" class="img-fluid">
                </li>
                @endforeach
            </ul>

            <h4>Benefits</h4>
            <ul>

                <li>{{ $product->benefit }}</li>

            </ul>

            <h4>Questions and Answers</h4>
            <ul>
                @foreach($product->questionAnswers as $question)
                <li>
                    <strong>Q:</strong> {{ $question->question }}<br>
                    <strong>A:</strong> {{ $question->answer }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection