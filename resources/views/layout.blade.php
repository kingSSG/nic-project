<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name='csrf_token' content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Css -->
    <link href="{{ URL('css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- Common Css -->
    <link href="{{ URL('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!--// Common Css -->
    <!-- Nav Css -->
    <link rel="stylesheet" href="{{ URL('css/style4.css') }}">
    <!--// Nav Css -->
    <!-- Fontawesome Css -->
    <link href="{{ URL('css/fontawesome-all.css') }}" rel="stylesheet">
    <!--// Fontawesome Css -->
    <!--// Style-sheets -->

    <!--web-fonts-->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!--//web-fonts-->
    @yield('style')
    <style>
        body {
            font-family: 'Open Sans', sans-serif;


            background-attachment: fixed;

            background-position: center center;
            background-size: cover;
        }

        .pageheader {
            background: rgb(12, 142, 12);
            /* color: #fff; */
        }

        /* .copyright-w3layouts {
            overflow: hidden !important;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
        } */

        #CM {
            padding-top: 20px;
        }

        #footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 10px;
            
        }
    </style>
</head>

<body>
    <div class="pageheader">
        <div class="container-fluid clearfix">
            <div class="row">
                <div class="col-xl-3 col-lg-3  col-md-3 text-left"><img style="height:70%; width:15%;"
                        src="{{ URL('assets/img/Emblem_of_India.png') }}" class="emblem" /></div>
                <div class="col-xl-6 col-lg-6  col-md-6 text-center  mt-3 mb-3">
                    <h1 id="CM">Chief Minister Report</h1>
                </div>
                <div class="col-xl-3 col-lg-3  col-md-3 text-right"><img style="height:80%; width:40%;"
                        src="{{ URL('assets/img/Mamata-Banerjee.png') }}" class="img-fluid wbimg" /></div>
            </div>
        </div>
    </div>

    @yield('content')
     
     <div id="footer">

         <div class="copyright-w3layouts py-xl-3 py-2 mt-xl-5 mt-4 text-center footer_margin">
             <p>Designed and developed by-
                 <a href="https://www.nic.in/"> NIC,</a> Jalpaiguri District Unit
             </p>
         </div>
     </div>



    @include('sweetalert::alert')
    @yield('scripts')



    <script src="{{ URL('js/bootstrap.min.js') }}"></script>

    <script src="{{ URL('js/script.js') }}"></script>

    <script src="{{ URL('js/jQuery.min.js') }}"></script>

</body>

</html>
