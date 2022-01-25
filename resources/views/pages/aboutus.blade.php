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
            @foreach($gallery as $photo)
                @if($photo->is_active)
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{asset('gallery/' . $photo->image)}}" class="d-block mb-4 h-100" data-fancybox>
                            <img class="img-fluid img-thumbnail" src="{{asset('gallery/' . $photo->image)}}" alt="">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ mix('js/about_us.js') }}"></script>
@endsection
