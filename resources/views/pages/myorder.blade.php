@extends('main')
@section('content')
    <!-- Page Header Section -->
    <div class="page-header about-us">
        <div id="myorder-page-title" class="page-title">
            {{ __('myorder_page_title') }}
        </div>
    </div>

    <!-- Order Section -->
    <div class="myorder-form">
        <div id="myorder-page-desc" class="page-desc">
            {!! __('myorder_page_desc') !!}
        </div>
        <div class="myorder-section">
            <form id="myorder-form" action="#" method="POST">
                @csrf
                <div class="container-fluid">
                    <div class="row">
                        <div id="booking-col-1" class="col-md-4 booking">
                            <input id="myorder-input1" class="form-control form-control-lg myorder-input" type="text"
                                name="id" placeholder="{{ __('myorder_input1') }}" aria-label=".form-control-lg example"
                                required>
                        </div>
                        <div id="booking-col-2" class="col-md-4 booking">
                            <input id="myorder-input2" class="form-control form-control-lg myorder-input" type="email"
                                name="email" placeholder="{{ __('myorder_input2') }}"
                                aria-label=".form-control-lg example" required>
                        </div>
                        <div id="booking-col-6" class="col-md-4 booking">
                            <div class="d-grid gap-2">
                                <button id="myorder-input3" type="submit" class="btn btn-dark btn-lg">
                                    {{ __('myorder_input3') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ mix('js/my_order.js') }}"></script>
    <script src="js/toast/jquery.toast.min.js"></script>
@endsection
