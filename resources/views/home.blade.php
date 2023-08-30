@extends('layout')
@section('title', 'Home')
@section('style')
    <style>
        .carouselSize {
            height: 60%;

        }

        .footer_item_size {
            height: 110px;
        }



        .carousel-image-size {
            width: 100%;
            height: 600px;
        }

        #sign_in {
            padding-top: 10px;
            margin-top: 25px;
            width: 100px;
            height: 50px;

        }
    </style>

@endsection
@section('content')

    @include('common_carousel')


    <div class="footer">
        <div class="container">
            <br>
            <div class="row">
                <div class="col">
                    <a href="{{ route('index') }}"> <img class="footer_item_size" alt=""
                            src="{{ URL('assets/logos/kcc.png') }}" /></a>
                </div>
                <div class="col">
                    <a href="{{ route('index') }}"><img class="footer_item_size" alt=""
                            src="{{ URL('assets/logos/kisan_mandi.png') }}" /></a>
                </div>
                <div class="col">
                    <a id="sign_in" href="{{ route('index') }}" class="btn btn-primary">Sign In</a>
                </div>
                <div class="col">
                    <a href="{{ route('index') }}"><img class="footer_item_size" alt=""
                            src="{{ URL('assets/logos/anandadhara.png') }}" /></a>
                </div>
                <div class="col">
                    <a href="{{ route('index') }}"><img class="footer_item_size" alt=""
                            src="{{ URL('assets/logos/mgnrega.png') }}" /></a>
                </div>
            </div>

        </div>
    </div>



@endsection
@section('scripts')
    <script src="{{ URL('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL('js/jQuery.min.js') }}"></script>

@endsection
