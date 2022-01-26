@extends('main')
@section('content')
    <!-- Page Header Section -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.2/viewer.min.css" integrity="sha512-r+5gXtPk5M2lBWiI+/ITUncUNNO15gvjjVNVadv9qSd3/dsFZdpYuVu4O2yELRwSZcxlsPKOrMaC7Ug3+rbOXw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                        <a href="javascript:void(0)" class="d-block mb-4 h-100" data-fancybox>
                            <img class="img-fluid img-thumbnail" src="{{asset('gallery/' . $photo->image)}}" alt="">
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.2/viewer.min.js" integrity="sha512-lzNiA4Ry7CjL8ewMGFZ5XD4wIVaUhvV3Ct9BeFmWmyq6MFc42AdOCUiuUtQgkrVVELHA1kT7xfSLoihwssusQw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ mix('js/about_us.js') }}"></script>
@endsection
