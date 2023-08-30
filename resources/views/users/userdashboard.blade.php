@extends('layout')
@section('title', 'user dashboard')
@section('style')
    <link rel="stylesheet" href="{{ URL('css/user_dashboard/dropdown.css') }}">
    <style>
           .carouselSize {
            height: 65%;

        }
        .carousel-image-size{
        width: 100%;
        height: 600px;
       }


    </style>
@endsection



@section('content')
    <div class="container-fluid clearfix">
        <div class="row">
            <nav class="navbar navbar-default" style="width:100%; background:#3f96c9;">
                <div id="cssmenu">
                    <div id="head-mobile"></div>
                    <div class="button"></div>
                    <ul class="nav navbar-nav navbar-right">
                        @foreach ($userMenus as $menu)
                            <li class=""><a href="#">{{ $menu->menu }}</a>
                                <ul class="firstch">
                                    @foreach ($submenus[$menu->menu_cd] as $submenu)
                                        <li style="margin-bottom:4px;">
                                            <a href="{{ route("users.$submenu->link") }}">{{ $submenu->submenu }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach

                        <li><a href="{{ route('users.showExcelReportCritera') }}">Show Excel Report</a></li>
                        <li><a href="{{ route('users.logout') }}" >Logout</a></li>

                    </ul>
                </div>
            </nav>
        </div>
    </div>

    @include('common_carousel')
@endsection
@section('scripts')

    <script src="{{ URL('js/jQuery.min.js') }}"></script>
    <script src="{{ URL('js/bootstrap.min.js') }}"></script>

@endsection
