@extends('main')
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="about-us-page-title" class="page-title">
            {{ __('about_us_page_title') }}
        </div>
    </div>

    <!-- Description Section -->
    <div id="about-us-page-desc" class="page-description about-us">
    </div>

    <!-- Gallery Section -->
    <div id="aboutus_gallery" class="container">
        <h1 id="about-us-gallery-title" class="fw-light text-center text-lg-start mt-4 mb-0">
            {{ __('about_us_gallery_title') }}
        </h1>
        <hr class="mt-2 mb-5">
        <div class="row text-center text-lg-start">
            <!-- Add photo logic -->
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/about_us.js') }}"></script>
@endsection
